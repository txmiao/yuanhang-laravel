<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/20
 * Time: 18:37
 */

namespace App\Services;


use App\Models\Address;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\User;

class CartService
{

    protected $user;
    public $cart;
    public $cart_formated;
    protected $cart_model;

    public function __construct(User $user)
    {
        $this->user=$user;
        $this->cart_model=$this->user->carts();
    }

    protected function init_cart($cart_id=null,$hide_no_selected=false){
        $cart=$this->cart_model->get();
        $selected=[];
        if(is_null($cart_id)){

        }elseif(is_array($cart_id)){
            $selected=$cart_id;
        }else{
            $selected[]=$cart_id;
        }


        foreach($cart as $key=>$c){
            if($hide_no_selected){
                if(in_array($cart[$key]->id,$selected)){
                    $cart[$key]->selected=1;
                }else{
                    unset($cart[$key]);
                }
            }else{
                if(in_array($cart[$key]->id,$selected)){
                    $cart[$key]->selected=1;
                }else{
                    $cart[$key]->selected=0;
                }
            }
        }
        $this->cart=$cart;
    }



    /***
     * 加入购物车
     */
    public function addToCart($goods_id,$type,$num){

        //判断商品是否存在
        $goods_service=new GoodsService();
        $goods_condition=['id'=>$goods_id,'type'=>$type];
        $goods=$goods_service->find($goods_condition);
        if(is_null($goods)){
            return CommonService::status_return(false,[],__('messages.cart.goods_not_found'));
        }

        //判断商品库存是否充足
        if($goods->inventory-$num<0){
            return CommonService::status_return(false,[],__('messages.cart.not_inventory'));
        }

        //判断用户购物车是否有相同商品
        $cart_goods=$this->cart_model->where(['goods_id'=>$goods->id,'goods_type'=>$goods->type])->first();
        if(is_null($cart_goods)){
            //没有该商品
            $goods_data=[
                'goods_id'=>$goods->id,
                'goods_type'=>$goods->type,
                'store_id'=>$goods->partner_store->id,
                'store_type'=>$goods->partner_store->type,
                'number'=>$num,
                'total_price'=>$goods->price*$num
            ];
            $result=CommonService::store(Cart::class,$goods_data,$this->cart_model);

        }else{
            //有该商品  增加商品数量
            $update_data=[
                'number'=>$cart_goods->number+$num,
                'total_price'=>($cart_goods->number+$num)*$goods->price
            ];
            $result=CommonService::update($cart_goods,$update_data);
        }

        return $result;
    }

    /****
     * 更新购物车
     */
    public function updateCart($cart_id,$type="update",$num=1){
        //判断商品是否存在
        $cart=$this->cart_model->find($cart_id);
        if(is_null($cart)){
            return CommonService::status_return(false,[],__('messages.cart.cart_not_found'));
        }

        switch($type){
            case "delete":
                $result=CommonService::delete($cart);
                break;
            case "update":
                //判断商品库存是否充足
                if($cart->goods->inventory-$num<0){
                    return false;
                }
                $data=['number'=>$num,"total_price"=>$cart->goods->price*$num];
                $result=CommonService::update($cart,$data);
                break;
        }

        return $result;

    }

    /**
     * 清空购物车
     */
    public function clearCart(){
        if($this->cart_model->delete()){
            return CommonService::status_return(true,[],__('messages.cart.cart_clear_success'));
        }
        return CommonService::status_return(false,[],__('messages.cart.cart_clear_failure'));
    }

    /***
     * 获取购物车信息
     */
    public function getCart($cart_id=null,$hide_no_seleted=false){
        $this->init_cart($cart_id,$hide_no_seleted);
        return $this->cart;
    }

    /**
     * 格式化购物车
     * @return array
     */
    public function formatCart(){
        //根据商品 店铺类型和店铺id 进行归类
        $cart_formated=[
            'detail'=>[],
            'total'=>[
                'amount'=>0,
                'goods_number'=>0,
                'goods_kinds'=>0,
                'price_total'=>0,
                'cash_total'=>0,
                'credit_score_total'=>0,
                'coupons_total'=>0,
                'shipping_total'=>0
            ]
        ];
        foreach($this->cart as $cart_goods){
            $format_key=$cart_goods->store_type."_".$cart_goods->store_id;
            $found=false;
            foreach($cart_formated as $key=>$temp_cart){
                if(isset($temp_cart['cart_store_type'])&&$temp_cart['cart_store_type']==$format_key){
                    $found=$key;
                    break;
                }
            }

            if(!isset($cart_formated[$found]['store'])){
                $cart_formated['detail'][$format_key]['store']=$cart_goods->store;
            }
            $cart_formated['detail'][$format_key]['goods'][]=$cart_goods;
        }
        return $this->cart_formated=$cart_formated;
    }

    /**
     * 计算商品合计价格
     */
    public function calcCart($cart_pre_pay=[],Address $address=null){
        //循环当前购物车选中商品  检查必须有格式化列表
        if(!is_null($this->cart_formated['detail'])){
            foreach($this->cart_formated['detail'] as $store_key=>$store_cart){
                $store_total=[
                    'amount'=>0,
                    'goods_number'=>0,
                    'goods_kinds'=>0,
                    'price_total'=>0,
                    'cash_total'=>0,
                    'credit_score_total'=>0,
                    'coupons_total'=>0,
                    'shipping_fee'=>0,
                ];
                foreach($store_cart['goods'] as $cart_key=>$cart_goods){
                    $goods_kinds=0;
                    $goods_number=0;
                    $cash=0;
                    $score=0;
                    $coupon=0;
                    $shipping_fee=0;
                    if($cart_goods->selected){
                        $goods_kinds+=1;
                        $goods_number+=$cart_goods->number;
                        //计算商品计费
                        $key=0;
                        $price_schemes=$cart_goods->goods->pricing_schemes;
                        if(isset($cart_pre_pay[$cart_goods->id])){
                            $desc=$cart_pre_pay[$cart_goods->id]['desc']??"";
                            $cash=$cart_pre_pay[$cart_goods->id]['cash']??0*$cart_goods->number;
                            $score=$cart_pre_pay[$cart_goods->id]['credit_score']??0*$cart_goods->number;
                            $coupon=$cart_pre_pay[$cart_goods->id]['coupons']??0*$cart_goods->number;
                            foreach($price_schemes as $index=>$price){
                                if($cart_pre_pay[$cart_goods->id]['desc']==$price['desc']&&$cart_pre_pay[$cart_goods->id]['cash']==$price['cash']&&$cart_pre_pay[$cart_goods->id]['credit_score']==$price['credit_score']&&$cart_pre_pay[$cart_goods->id]['coupons']==$price['coupons']){
                                    $key=$index;
                                    break;
                                }
                            }
                        }else{
                            $desc=$price_schemes[0]['desc'];
                            $cash=($price_schemes[0]['cash']??0)*$cart_goods->number;
                            $score=($price_schemes[0]['credit_score']??0)*$cart_goods->number;
                            $coupon=($price_schemes[0]['coupons']??0)*$cart_goods->number;
                        }
                        $price_schemes=[
                                'desc'=>$desc,
                                'cash'=>$cash,
                                'credit_score'=>$score,
                                'coupons'=>$coupon,
                                'key'=>$key,
                        ];
                        //结算方式
                        $this->cart_formated['detail'][$store_key]['goods'][$cart_key]->pricing_schemes=$price_schemes;
                        //计算运费
                        if(isset($cart_pre_pay[$cart_goods->id]['shipping'])&&!is_null($cart_pre_pay[$cart_goods->id]['shipping'])){
                            $this->cart_formated['detail'][$store_key]['goods'][$cart_key]->shipping_id=$cart_pre_pay[$cart_goods->id]['shipping']->id;
                            $shipping_fee=$cart_pre_pay[$cart_goods->id]['shipping']->calc($cart_goods,$address);
                            $store_total['shipping']=$cart_pre_pay[$cart_goods->id]['shipping'];
                        }

                        //叠加商品总价
                        $store_total['goods_number']+=$goods_number;
                        $store_total['goods_kinds']+=$goods_kinds;
                        $store_total['price_total']+=$cart_goods->price_total;
                        $store_total['cash_total']+=$cash;
                        $store_total['credit_score_total']+=$score;
                        $store_total['coupons_total']+=$coupon;
                        $store_total['shipping_fee']+=$shipping_fee;
                        $store_total['amount']+=$cash+$coupon+$score+$shipping_fee;
                    }
                }
                $this->cart_formated['detail'][$store_key]['summary']=$store_total;
                //增加总计
                $this->cart_formated['total']['amount']+=$store_total['amount'];
                $this->cart_formated['total']['goods_number']+=$store_total['goods_number'];
                $this->cart_formated['total']['goods_kinds']+=$store_total['goods_kinds'];
                $this->cart_formated['total']['price_total']+=$store_total['price_total'];
                $this->cart_formated['total']['cash_total']+=$store_total['cash_total'];
                $this->cart_formated['total']['credit_score_total']+=$store_total['credit_score_total'];
                $this->cart_formated['total']['coupons_total']+=$store_total['coupons_total'];
                $this->cart_formated['total']['shipping_total']+=$store_total['shipping_fee'];

            }
        }
    }

    /**
     * 格式化json
     * @return array
     */
    public function parseJson(){
        $json=[];
        $json['total']=$this->cart_formated['total'];
        $total_item=0;
        $selected_item=0;
        foreach($this->cart_formated['detail'] as  $store){
            $store_info=$store['store']->resource();
            $summary_info=$store['summary'];
            $goods_info=[];
            $selected=0;
            foreach($store['goods'] as $goods_key=>$goods){
                $total_item++;
                if($goods->selected){
                    $selected++;
                    $selected_item++;
                }
                $goods_info[]=$goods->resource();
            }
            if($selected==count($goods_info)&&$selected!=0){
                $store_info['selected']=1;
            }else{
                $store_info['selected']=0;
            }
            $json['detail'][]=[
                'store'=>$store_info,
                'summary'=>$summary_info,
                'goods'=>$goods_info
            ];
        }
        if($total_item==$selected_item&&$total_item!=0){
            $json['total']['selected']=1;
        }else{
            $json['total']['selected']=0;
        }
        return $json;
    }


    /**
     * 购物流程以外使用的小计
     * @return array
     */
    public function summary(){
        $result=$this->cart_model->sum('total_price');
        return CommonService::status_return(true,$result);
    }
}