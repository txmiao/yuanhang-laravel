<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Shipping;
use App\Services\CartService;
use App\Services\CommonService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /***
     * 购物车商品列表
     */
    public function index(Request $request){
        $cart_service=new CartService($this->user());
        $cart_id=$request->input('cart_id',null);

        //初始化购物车
        $cart_service->getCart($cart_id);
        //格式化购物车
        $cart_service->formatCart();
        //计算购物车
        $cart_service->calcCart();
        //转换json
        $json=$cart_service->parseJson();

        return $this->response->array($json);
    }

    /***
     * 加入购物车
     */
    public function addToCart(Request $request){
        $goods_id=$request->get('goods_id',0);
        $goods_type=$request->get('goods_type','default');
        $num=$request->get('num',0);

        $cart_service=new CartService($this->user());
        $result=$cart_service->addToCart($goods_id,$goods_type,$num);
        if($result['status']){
            return $this->response->noContent();
        }else{
            return $this->response->errorBadRequest($result['msg']);
        }
    }


    /**
     * 更新购物车
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request){
        $cart_id=$request->get('cart_id',0);
        $type=$request->get('type',"update");
        $num=$request->get('num',0);

        $cart_service=new CartService($this->user());
        $result=$cart_service->updateCart($cart_id,$type,$num);
        if($result['status']){
            return $this->response->noContent();
        }else{
            return $this->response->errorBadRequest($result['msg']);
        }
    }

    public function clear(){
        $cart_service=new CartService($this->user());
        $result=$cart_service->clearCart();
        if($result['status']){
            return $this->response->noContent();
        }else{
            return $this->response->errorBadRequest($result['msg']);
        }
    }

    public function summary(){
        $cart_service=new CartService($this->user());
        $summary=$cart_service->summary();
        if($summary['status']){
            return $this->response->array(['total'=>$summary['data']]);
        }else{
            return $this->response->errorBadRequest($summary['msg']);
        }

    }


    public function checkout(Request $request){
        $cart_service=new CartService($this->user());

        //结算方式
        $settlement=$request->input('settlement',[]);
        if(count($settlement)<1){
            return $this->response->error(__('messaages.cart.cart_not_selected'),5001);
        }



        //获取到购物车id
        $cart_id=[];
        //默认运输fangshi
        $default_shipping=Shipping::orderBy('sort')->first();
        $settlement_input=[];
        foreach($settlement as $d){
            array_push($cart_id,$d['cart_id']);
            //重新组织结算参数
            if(!empty($d['shipping_id'])){
                $shipping=Shipping::find($d['shipping_id']);
            }else{
                $shipping=$default_shipping;
            }

            if(isset($d['pricing_schemes'])){

                $settlement_input[$d['cart_id']]=[
                    'desc'=>$d['pricing_schemes']['desc'],
                    'cash'=>$d['pricing_schemes']['cash'],
                    'credit_score'=>$d['pricing_schemes']['credit_score'],
                    'coupons'=>$d['pricing_schemes']['coupons'],
                    'shipping'=>$shipping
                ];

            }
        }

        //获取用户收货地址
        $address_id=$request->get('address_id',0);
        $address=Address::find($address_id);
        if(is_null($address)){
            $address=$this->user()->address()->default()->first();
            if(is_null($address)){
                $address=$this->user()->address()->first();
            }
        }



        //初始化购物车
        $cart_service->getCart($cart_id,true);
        //格式化购物车
        $cart_service->formatCart();
        //计算购物车
        $cart_service->calcCart($settlement_input,$address);
        //转换json
        $json=$cart_service->parseJson();

        return $this->response->array($json);
    }
}
