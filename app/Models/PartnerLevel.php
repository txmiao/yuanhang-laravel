<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerLevel extends Model
{
    protected $table = 'partner_levels';
    protected $guarded = ['_token'];
    public $timestamps = false;
    protected $casts = [
        'sku_number' => 'array'
    ];

    public static $levels = [
        'a' => '合伙人',
        'b' => '银牌合伙人',
        'c' => '金牌合伙人',
        'd' => '钻石合伙人',
    ];
}
