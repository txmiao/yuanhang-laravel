<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 14:52
 */

namespace App\Transformers;


use App\Models\Cart;
use App\Models\PartnerGoods;
use League\Fractal\TransformerAbstract;

class CartTransformer extends TransformerAbstract
{
    public function transform(Cart $cart){
        $data=[
            "id"=>$cart->id,
            "store"=>$cart->store->resource(),
            'goods'=>$cart->goods->resource(),
            'number'=>$cart->number,
            'pricing_schemes'=>$this->getPricingSchemes($cart),
            'total_price'=>$cart->total_price,
            'selected'=>$cart->selected??1,
            'shipping_id'=>$this->getShipping($cart)
        ];
        return $data;
    }

    private function getPricingSchemes($cart){
        if(isset($cart->pricing_schemes)){
            return $cart->pricing_schemes;
        }
    }

    private function getShipping($cart){
        if(isset($cart->shipping_id)){
            return $cart->shipping_id;
        }
        return 0;
    }
}