<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponsRecord extends Model
{
    protected $table = 'coupons_records';
    protected $guarded = ['_token'];

    const EVENT_INVITATION="invitation";
    const EVENT_REGISTER="register";
    const EVENT_BINDPHONE="bind_phone";
    const EVENT_SIGNIN="sign_in";
    const EVENT_DEDUCT="duduct";
    const EVENT_CHANGED="changed";

    public static $originEventText = [
        'invitation' => '邀请',
        'register' => '新用户注册',
        'bind_phone' => '绑定手机号',
        'sign_in' => '签到',
        'deduct' => '购买商品抵扣',
        // ...
    ];

    public static function message($key){
        return __("messages.coupon_record.{$key}");
    }
}
