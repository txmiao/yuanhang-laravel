<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FlagshipStoreRecord extends Model
{
    protected $table = 'flagship_store_records';
    protected $guarded = ['_token'];

    const LEVEL_PROVINCE = 100;
    const LEVEL_CITY = 101;
    const LEVEL_DISTRICT = 102;

    const STATUS_VACANCY = 100;
    const STATUS_AUDITING = 101;
    const STATUS_MERCHANTED = 102;

    public static $levelText = [
        self::LEVEL_PROVINCE => '<span class="label label-default">省级</span>',
        self::LEVEL_CITY => '<span class="label label-default">市级</span>',
        self::LEVEL_DISTRICT => '<span class="label label-default">区级</span>',
    ];

    public static $statusText = [
        self::STATUS_VACANCY => '<span class="label label-default">空缺中</span>',
        self::STATUS_AUDITING => '<span class="label label-warning">审核中</span>',
        self::STATUS_MERCHANTED => '<span class="label label-success">已招募</span>',
    ];

    /**
     * 获取关联的专卖店信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(SpecialStore::class, 'store_id');
    }

    /**
     * 初始化区域代理记录
     * @return mixed
     */
    public static function build_init_data()
    {
        $regions = Region::getRegionsWithChild();
        $insertData = [];
        if ($regions) {
            foreach ($regions['province'] as $regionItem) {
                foreach ($regionItem['city'] as $regionSubItem) {
                    foreach ($regionSubItem['district'] as $item) {
                        array_push($insertData, [
                            'level' => 102,
                            'parent_code' => $regionSubItem['code'],
                            'location_code' => $item['code'],
                            'location_name' => $item['name'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    array_push($insertData, [
                        'level' => 101,
                        'parent_code' => $regionItem['code'],
                        'location_code' => $regionSubItem['code'],
                        'location_name' => $regionSubItem['name'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
                array_push($insertData, [
                    'level' => 100,
                    'parent_code' => 86,
                    'location_code' => $regionItem['code'],
                    'location_name' => $regionItem['name'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        return self::insert($insertData);
    }

    /**
     * 获取加盟地区列表
     * @param int $parent_code
     * @param int $level
     * @return mixed
     */
    public static function get_flagship_store_records($parent_code = 86, $level = self::LEVEL_PROVINCE)
    {
        $currentFee = self::get_fee_for_merchants_join_by_user_count($level);
        $lists = self::where('parent_code', $parent_code)->orderBy('location_code')->paginate(20);
        if ($lists) {
            foreach ($lists as $k => $list) {
                $lists[$k]['participation_fee'] = $currentFee;
            }
        }
        return $lists;
    }

    /**
     * 根据当前用户数获取对应的系统资源使用费（加盟费）
     * @param int $level
     * @return int
     */
    public static function get_fee_for_merchants_join_by_user_count($level = self::LEVEL_PROVINCE)
    {
        switch ($level) {
            default:
            case self::LEVEL_PROVINCE:
                $levelKey = 'province';
                break;
            case self::LEVEL_CITY:
                $levelKey = 'city';
                break;
            case self::LEVEL_DISTRICT:
                $levelKey = 'district';
                break;
        }
        $currentFee = 0;
        $userCount = User::count();
        $config = System::pluck('value', 'code');
        $sysConfigCounts = array_reverse(json_decode($config['participation_fee'], true)[$levelKey]);
        foreach ($sysConfigCounts as $k => $item) {
            $range = explode(',', $item['range']);
            if (!$k && $userCount > (int)$range[0]) {
                $currentFee = $item;
                break;
            } else if ($userCount >= $range[0] && $userCount <= $range[1]) {
                $currentFee = $item;
                break;
            }
        }

        return $currentFee;
    }

    /**
     * 更新地区加盟申请状态
     * @param MerchantsJoinApplyRecord $merchantsJoinApplyRecord
     * @param $status
     * @return bool
     * @throws \Exception
     */
    public function update_record(MerchantsJoinApplyRecord $merchantsJoinApplyRecord, $status)
    {
        $conditions = ['level' => $merchantsJoinApplyRecord->level];
        switch ($merchantsJoinApplyRecord->level) {
            case MerchantsJoinApplyRecord::LEVEL_PROVINCE:
                $location_code = $merchantsJoinApplyRecord->province;
                break;
            case MerchantsJoinApplyRecord::LEVEL_CITY:
                $location_code = $merchantsJoinApplyRecord->city;
                break;
            case MerchantsJoinApplyRecord::LEVEL_DISTRICT:
                $location_code = $merchantsJoinApplyRecord->district;
                break;
        }

        $conditions = array_merge($conditions, compact('location_code'));
        $record = self::where($conditions)->first();

        //添加申请时，如果地区代理已招募直接拒绝
        if (self::STATUS_MERCHANTED == $record->status && self::STATUS_AUDITING == $status) {
            throw new \Exception('当前区域专卖店已招募');
        } else {
            $record->update(['status' => $status]);
        }
        return true;
    }
}
