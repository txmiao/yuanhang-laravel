<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    protected $table = 'order_goods';
    protected $guarded = ['_token'];
    protected $casts=[
        'pricing_schemes'=>'array'
    ];

    public function goods()
    {
        return $this->morphTo();
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public static function message($key){
        return __("messages.order_goods.{$key}");
    }
}
