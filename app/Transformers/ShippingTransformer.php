<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 14:52
 */

namespace App\Transformers;


use App\Models\Order;
use App\Models\Shipping;
use League\Fractal\TransformerAbstract;

class ShippingTransformer extends TransformerAbstract
{
    public function transform(Shipping $shipping){
        $data=$shipping->toArray();
        return $data;
    }

}