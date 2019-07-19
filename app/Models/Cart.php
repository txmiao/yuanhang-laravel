<?php

namespace App\Models;

use App\Transformers\CartTransformer;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = ['_token'];

    /**
     * 关联店铺
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function store(){
        return $this->morphTo();
    }

    /**
     * 关联商品
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function goods(){
        return $this->morphTo();
    }

    public static function message($key){
        return __("messages.cart.{$key}");
    }


    /**
     * 资源化
     * @return CartTransformer
     */
    public function resource(){
        $tranformer=new CartTransformer();
        return $tranformer->transform($this);
    }
}
