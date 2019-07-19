<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 14:52
 */

namespace App\Transformers;


use App\Models\PartnerGoods;
use League\Fractal\TransformerAbstract;

class PartnerGoodsTransformer extends TransformerAbstract
{
    public function transform(PartnerGoods $goods){
        return [
            "id"=>$goods->id,
            "name"=>$goods->name,
            'subtitle'=>$goods->subtitle,
            'sku_num'=>$goods->sku_number,
            'price'=>$goods->price,
            'pricing_schemes'=>$goods->pricing_schemes,
            'inventory'=>$goods->inventory,
            'pre_discount_price'=>$goods->pre_discount_price,
            'thumbnail'=>$goods->thumbnail,
            'images'=>$goods->images,
            'service_tips_ids'=>$goods->service_tips_ids,
            'detail'=>$goods->detail,
            'detail_ext'=>$goods->detail_ext,
            'partner_store'=>$goods->partner_store,
            'is_sale'=>$goods->is_sale,
            'is_recommend'=>$goods->is_recommend,
            'is_hot'=>$goods->is_hot,
            'type'=>$goods->type
        ];
    }
}