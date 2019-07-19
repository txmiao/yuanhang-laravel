<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\Shipping;
use App\Services\CartService;
use App\Services\OrderService;
use App\Transformers\OrderDetailTransformer;
use App\Transformers\OrderTransformer;
use Dingo\Api\Transformer\Factory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    /**
     * 订单列表
     */
    public function index(Request $request){
        $order_service=new OrderService($this->user());
        $param['status']=$request->get('status',Order::STATUS_WAIT_PAY);
        $param['order']=$request->get('order','created_at');
        $param['sort']=$request->get('sort','desc');
        $response=$order_service->query($param);
        if($response['status']){
            return $this->response->paginator($response['data'],new OrderTransformer());
        }
        return $this->response->array([]);
    }

    /**
     * 订单详情
     */
    public function show(Request $request){
        $id=$request->input('id');
        $order=$this->user()->orders()->find($id);
        if(is_null($order)){
            return $this->response->errorNotFound(__('messages.order.not_found'));
        }
        return $this->response->item($order,new OrderTransformer());
    }

    /**
     * 订单统计
     */
    public function statement(){

    }


    /**
     * 订单结算
     */
    public function store(Request $request){

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

            $settlement_input[$d['cart_id']]=[
                'desc'=>$d['pricing_schemes']['desc'],
                'cash'=>$d['pricing_schemes']['cash'],
                'credit_score'=>$d['pricing_schemes']['credit_score'],
                'coupons'=>$d['pricing_schemes']['coupons'],
                'shipping'=>$shipping
            ];
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
        //生成订单
        $order_service=new OrderService($this->user());
        $result=$order_service->create_order($cart_service->cart_formated,$address);
        if($result['status']){
            return $this->response->array($result['data']);
        }

        return $this->response->array(['message'=>$result['msg'],'status_code'=>1001]);

        //return $this->response->array($json);
    }

    public function address(){

    }


    public function receive(Request $request){
        $id=$request->input('id');
        $order=$this->user()->orders()->find($id);
        if(is_null($order)){
            return $this->response->errorNotFound(__('messages.order.not_found'));
        }
        $result=OrderService::receive($order);
        if($result['status']){
            return $this->response->noContent();
        }
        return $this->response->array(['message'=>$result['msg'],'status_code'=>1001]);
    }

    public function summary(){

    }




}

