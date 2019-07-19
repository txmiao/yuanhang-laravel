<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 14:52
 */

namespace App\Transformers;


use App\Models\Order;
use App\Models\OrderGoods;
use League\Fractal\TransformerAbstract;

class OrderGoodsTransformer extends TransformerAbstract
{
    public function transform(OrderGoods $orderGoods){
        $data=[
            'goods'=>$orderGoods->goods->resource(),
            'pricing_schemes'=>$orderGoods->pricing_schemes,
            'number'=>$orderGoods->number,
            'subtotal'=>$orderGoods->subtotal,
            'goods_snapshot'=>$orderGoods->goods_snapshot,
        ];

        return $data;
    }

}