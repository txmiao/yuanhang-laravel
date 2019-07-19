<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceTip extends Model
{
    protected $table = 'service_tips';
    protected $guarded = ['_token', 'icon_upload'];
    public $timestamps = false;

    const BIND_TYPE_ALL = 100;
    const BIND_TYPE_PARTNER = 101;
    const BIND_TYPE_SPECIAL = 102;
    const BIND_TYPE_COMMUNITY = 103;
    const BIND_TYPE_FACTORY = 104;

    public static $bindTypeText = [
        self::BIND_TYPE_ALL => '<span class="label label-default">全平台</span>',
        self::BIND_TYPE_PARTNER => '<span class="label label-info">合伙人商城</span>',
        self::BIND_TYPE_SPECIAL => '<span class="label label-success">专卖店</span>',
        self::BIND_TYPE_COMMUNITY => '<span class="label label-warning">社区店</span>',
        self::BIND_TYPE_FACTORY => '<span class="label label-danger">厂家直营店</span>',
    ];
}
