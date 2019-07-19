<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PlatformPurchaseRecord extends Model
{
    protected $table = 'platform_purchase_records';
    protected $guarded = ['_token'];

    protected $casts = [
        'images' => 'array',
        'detail' => 'array',
    ];

    const GOODS_TYPE_PARTNER = 100;
    const GOODS_TYPE_OTHER = 101;
    const STATUS_UN_CONFIRM = 100;
    const STATUS_CONFIRMED = 101;

    public static $goodsTypeText = [
        self::GOODS_TYPE_PARTNER => '<span class="label label-success">合伙人商品</span>',
        self::GOODS_TYPE_OTHER => '<span class="label label-info">其它商品</span>',
    ];

    public static $statusText = [
        self::STATUS_UN_CONFIRM => '<span class="label label-warning">未确认</span>',
        self::STATUS_CONFIRMED => '<span class="label label-success">已确认</span>',
    ];

    public function platform_purchase_order()
    {
        return $this->belongsTo(PlatformPurchaseOrder::class, 'order_number', 'order_number');
    }

    /**
     * 构建采购商品记录数据
     * @param array $goodsId
     * @param array $goodsNumber
     * @param $orderNumber
     * @return array
     */
    public function build_data(array $goodsId, array $goodsNumber, $orderNumber)
    {
        $goodsArr = [];
        $goodsNumberByIdArr = [];
        if ($goodsId) {
            foreach ($goodsId as $k => $v) {
                array_push($goodsArr, [
                    'goods_id' => $v,
                    'number' => $goodsNumber[$k],
                ]);
            }
            foreach ($goodsArr as $item) {
                $goodsNumberByIdArr[$item['goods_id']][] = (int)$item['number'];
            }
        }

        //获取模板商品
        $goodsIds = array_keys($goodsNumberByIdArr);
        $templateGoods = TemplateGoods::whereIn('id', $goodsIds)->get();

        $orderAmount = 0;
        $platformPurchaseRecordData = [];
        foreach ($templateGoods as $good) {
            $orderAmount += (float)$good->price * array_sum($goodsNumberByIdArr[$good->id]);
            array_push($platformPurchaseRecordData, [
                'order_number' => $orderNumber,
                'type' => $good->type,
                'name' => $good->name,
                'subtitle' => $good->subtitle,
                'sku_number' => $good->sku_number,
                'thumbnail' => $good->thumbnail,
                'images' => json_encode($good->images),
                'price' => $good->price,
                'detail' => json_encode($good->detail),
                'detail_ext' => $good->detail_ext,
                'number' => array_sum($goodsNumberByIdArr[$good->id]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return compact('platformPurchaseRecordData', 'orderAmount');
    }
}
