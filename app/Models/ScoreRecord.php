<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoreRecord extends Model
{
    protected $table = 'score_records';
    protected $guarded = ['_token'];

    const SCORE_CREDIT = 100;
    const SCORE_GOLD = 101;
    const SCORE_SILVER = 102;

    const EVENT_INVITATION="invitation";
    const EVENT_REGISTER="register";
    const EVENT_BINDPHONE="bind_phone";
    const EVENT_SIGNIN="sign_in";
    const EVENT_DEDUCT="duduct";
    const EVENT_CHANGED="changed";

    public static $scoreTypeText = [
        self::SCORE_CREDIT => '<span class="label label-success">信用积分</span>',
        self::SCORE_GOLD => '<span class="label label-warning">金积分</span>',
        self::SCORE_SILVER => '<span class="label label-default">银积分</span>',
    ];

    public static $originEventText = [
        'invitation' => '邀请',
        'register' => '新用户注册',
        'bind_phone' => '绑定手机号',
        'sign_in' => '签到',
        'deduct' => '购买商品抵扣',
        'changed' => '积分商城兑换',
        // ...
    ];


    public static function message($key){
        return __("messages.score_record.{$key}");
    }

}
