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

class GoodsTransformer extends TransformerAbstract
{
    public function transform(PartnerGoods $goods){
        return [
            "id"=>$goods->id,
            "name"=>$goods->name
        ];
    }
}