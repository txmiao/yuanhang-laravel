<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 14:52
 */

namespace App\Transformers;


use App\Models\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['order_goods','parent','address','shipping','store'];
    public function transform(Order $order){
        $data=$order->toArray();
        $includes=[];
//        if(!is_null($order->parent)){
//            array_push($includes,'parent');
//        }
        if(!is_null($order->shipping)){
            array_push($includes,'shipping');
        }
        if(!is_null($order->address)){
            array_push($includes,'address');
        }
        if(!is_null($order->order_goods)){
            array_push($includes,'order_goods');
        }
        if(!is_null($order->store)){
            $data['store']=$this->includeStore($order);
        }
        $this->setDefaultIncludes($includes);
        return $data;
    }

    public function includeOrderGoods(Order $order){
        return $this->collection($order->order_goods,new OrderGoodsTransformer());
    }

    public function includeParent(Order $order){
        return $this->item($order->parent,new OrderTransformer());
    }

    public  function includeAddress(Order $order){
        return $this->item($order->address,new AddressTransformer());
    }

    public function includeShipping(Order $order){
        return $this->item($order->shipping,new ShippingTransformer());
    }

    public function includeStore(Order $order){
        return $order->store->resource();
    }

}