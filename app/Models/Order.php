<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = ['_token'];
    public $timestamps = [
        'expired_at',
        'paid_at',
        'shipping_at',
        'deal_done_at'
    ];

    const STATUS_WAIT_PAY = 100;
    const STATUS_WAIT_SHIP = 101;
    const STATUS_WAIT_RECEIVE = 102;
    const STATUS_WAIT_COMMENT = 103;
    const STATUS_COMPLETE = 104;
    const STATUS_CANCEL = 105;

    const PAY_TYPE_WECHAT = 100;
    const PAY_TYPE_ALIPAY = 101;
    const PAY_TYPE_UNION_PAY = 102;
    const PAY_TYPE_GOLD_SCORE = 103;

    const SHIPPING_METHOD_HOME_DELIVERY = 100;
    const SHIPPING_METHOD_SELF_TAKE = 101;

    public static $statusText = [
        self::STATUS_WAIT_PAY => '<label class="label label-warning">待付款</label>',
        self::STATUS_WAIT_SHIP => '<label class="label label-info">待发货</label>',
        self::STATUS_WAIT_RECEIVE => '<label class="label label-success">待收货</label>',
        self::STATUS_WAIT_COMMENT => '<label class="label label-info">待评价</label>',
        self::STATUS_COMPLETE => '<label class="label label-default">已完成</label>',
        self::STATUS_CANCEL => '<label class="label label-danger">已取消</label>',
    ];

    public static $payTypeText = [
        self::PAY_TYPE_WECHAT => '<label class="label label-success">微信支付</label>',
        self::PAY_TYPE_ALIPAY => '<label class="label label-info">支付宝</label>',
        self::PAY_TYPE_UNION_PAY => '<label class="label label-default">银联支付</label>',
        self::PAY_TYPE_GOLD_SCORE => '<label class="label label-warning">金积分</label>',
    ];

    public static $shippingMethodText = [
        self::SHIPPING_METHOD_HOME_DELIVERY => '<label class="label label-success">送货上门</label>',
        self::SHIPPING_METHOD_SELF_TAKE => '<label class="label label-info">上门自提</label>',
    ];

    public function store()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function order_goods()
    {
        return $this->hasMany(OrderGoods::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,"shipping_methods");
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_order_id');
    }

    public function sub_order(){
        return $this->hasMany(self::class,'parent_order_id');
    }

    public function shipment(){
        return $this->hasMany(Shipment::class);
    }


    public function scopeSub($query){
        return $query->where('is_main',0);
    }


    public static function makeOrderNo($user_id=0){
        $datetime=Carbon::now()->format('YmdHis');
        $string=str_pad($user_id,6,"0",STR_PAD_LEFT);
        return $datetime.$string;
    }


    public static function message($key){
        return __("messages.order.{$key}");
    }
}
