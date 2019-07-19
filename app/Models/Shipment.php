<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments'; //发货单表
    protected $guarded = ['_token'];

    const STATUS_UN_SHIPMENT = 100;
    const STATUS_SHIPPED = 101;

    public static $shippingStatusText = [
        self::STATUS_UN_SHIPMENT => '<span class="label label-warning">未发货</span>',
        self::STATUS_SHIPPED => '<span class="label label-success">已发货</span>',
    ];

    //快递公司列表
    public static $express = [
        ['express_company' => '顺丰快递', 'express_official_tel' => '95505'],
        ['express_company' => '圆通快递', 'express_official_tel' => '95506'],
        ['express_company' => '中通快递', 'express_official_tel' => '95507'],
    ];

    /**
     * 生成发货单
     * @param Order $order
     * @return mixed
     * @throws \Exception
     */
    public function insert_data(Order $order)
    {
        if (self::where('order_id', $order->id)->count()) {
            throw new \Exception('当前订单已存在发货单，不能重复生成');
        } else {
            return self::insert(['order_id' => $order->id]);
        }
    }


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeShipped($query){
        return $query->where('status',self::STATUS_SHIPPED);
    }
}
