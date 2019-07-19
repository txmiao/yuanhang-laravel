<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = 'labels';
    protected $guarded = ['_token'];
    public $timestamps = false;

    const USE_RANGE_ALL = 100;
    const USE_RANGE_PARTNER_STORE = 101;
    const USE_RANGE_SPECIAL_STORE = 102;
    const USE_RANGE_COMMUNITY_STORE = 103;
    const USE_RANGE_FACTORY_STORE = 104;

    public static $useRangeText = [
        self::USE_RANGE_ALL => '<label class="label label-default">全平台</label>',
        self::USE_RANGE_PARTNER_STORE => '<label class="label label-info">合伙人商城</label>',
        self::USE_RANGE_SPECIAL_STORE => '<label class="label label-success">专卖店</label>',
        self::USE_RANGE_COMMUNITY_STORE => '<label class="label label-warning">社区店</label>',
        self::USE_RANGE_FACTORY_STORE => '<label class="label label-danger">厂家直营店</label>',
    ];

}
