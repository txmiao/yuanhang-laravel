<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantsJoinApplyRecord extends Model
{
    protected $table = 'merchants_join_apply_records';
    protected $guarded = ['_token', 'essential_material_ids', 'other_material_ids'];
    protected $casts = [
        'essential_material' => 'array',
        'other_material' => 'array',
    ];

    const STATUS_WAIT_AUDIT = 100;
    const STATUS_PASS = 101;
    const STATUS_FAIL = 102;

    const TYPE_STORE_SPECIAL = 100;
    const TYPE_STORE_COMMUNITY = 101;
    const TYPE_STORE_FACTORY = 102;

    const LEVEL_PROVINCE = 100;
    const LEVEL_CITY = 101;
    const LEVEL_DISTRICT = 102;

    public static $typeStoreText = [
        self::TYPE_STORE_SPECIAL => '<label class="label label-default">专卖店</label>',
        self::TYPE_STORE_COMMUNITY => '<label class="label label-info">社区店</label>',
        self::TYPE_STORE_FACTORY => '<label class="label label-warning">厂家直营店</label>',
    ];

    public static $statusText = [
        self::STATUS_WAIT_AUDIT => '<label class="label label-warning">待审核</label>',
        self::STATUS_PASS => '<label class="label label-success">已通过</label>',
        self::STATUS_FAIL => '<label class="label label-danger">已拒绝</label>',
    ];

    public static $levelText = [
        self::LEVEL_PROVINCE => '<label class="label label-default">省级</label>',
        self::LEVEL_CITY => '<label class="label label-default">市级</label>',
        self::LEVEL_DISTRICT => '<label class="label label-default">区级</label>',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取推荐人信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recommend_user()
    {
        return $this->belongsTo(User::class, 'recommend_contact_phone', 'phone');
    }
}
