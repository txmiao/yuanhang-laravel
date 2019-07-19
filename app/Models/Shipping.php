<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    //
    protected $casts=[
        'config'=>"array"
    ];

    public function calc($cart_goods,$address=null){

        if(empty($this->config)){
            return 0;
        }
        //如果商品设置为免邮  则直接返回0
    }

    public function scopeActive($query){
        return $query->where('status',1);
    }
}
