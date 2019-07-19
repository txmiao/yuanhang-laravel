<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 14:52
 */

namespace App\Transformers;


use App\Models\PartnerStore;
use League\Fractal\TransformerAbstract;

class PartnerStoreTransformer extends TransformerAbstract
{
    public function transform(PartnerStore $store){
        return [
            "id"=>$store->id,
            "name"=>$store->name
        ];
    }
}