<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialStore extends Model
{
    protected $table = 'special_stores';
    protected $guarded = ['_token'];
    public $timestamps = ['expired_at'];
    protected $casts = [
        'phone' => 'array',
        'shop_env_images' => 'array',
        'business_hours' => 'array',
    ];
}
