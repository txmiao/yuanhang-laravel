<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformPurchaseOrder extends Model
{
    protected $table = 'platform_purchase_orders';
    protected $fillable = ['id', 'order_number', 'order_amount', 'consignee', 'phone', 'express_company',
        'express_number', 'pay_status', 'shipping_status'];

    const PAY_STATUS_UN_PAY = 100;
    const PAY_STATUS_PAID = 101;
    const SHIPPING_STATUS_WAIT_SHIPPING = 100;
    const SHIPPING_STATUS_SHIPPED = 101;

    public static $payStatusText = [
        self::PAY_STATUS_UN_PAY => '<label class="label label-warning">待付款</label>',
        self::PAY_STATUS_PAID => '<label class="label label-success">已付款</label>',
    ];

    public static $shippingStatusText = [
        self::SHIPPING_STATUS_WAIT_SHIPPING => '<label class="label label-warning">待发货</label>',
        self::SHIPPING_STATUS_SHIPPED => '<label class="label label-success">已发货</label>',
    ];
}
