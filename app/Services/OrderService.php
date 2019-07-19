<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/23
 * Time: 17:06
 */

namespace App\Services;


use App\Models\Address;
use App\Models\CouponsRecord;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\ScoreRecord;
use App\Models\Shipment;
use App\Models\Shipping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $user;
    public $order;
    public $cart;

    public function __construct(User $user=null)
    {
        if(!is_null($user)){
            $this->user=$user;
        }
    }

    public function create_order($cart,Address $address){
        //这里必须要用户id
        if(is_null($this->user)){
            return CommonService::status_return(false,[],__('messages.order.no_user'));
        }


        //查看购物车结算下来是否有多个店铺  如果只有单个  就不生成主订单  如果有多个  需要生成主订单
        DB::beginTransaction();
        $main_order=null;
        $order_no=Order::makeOrderNo($this->user->id);
        if(count($cart['detail'])>1){
            //多个
            //生成主订单
            $main_data=[
                'order_number'=>$order_no,
                'is_main'=>true,
                'parent_order_id'=>0,
                'user_id'=>$this->user->id,
                'address_id'=>$address->id,
                'order_money'=>$cart['total']['amount']??0,
                'deal_money'=>$cart['total']['cash_total']??0,
                'pay_money'=>0,
                'deal_credit_score'=>$cart['total']['credit_score_total']??0,
                'pay_credit_score'=>0,
                'deal_coupons_number'=>$cart['total']['coupons_total']??0,
                'pay_coupons_number'=>0,
                'shipping_fee'=>$cart['total']['shipping_total']??0,
                'shipping_methods'=>0,
                'remark'=>"主订单",
                'status'=>Order::STATUS_WAIT_PAY,
            ];
            //扣除商品代币部分
            if($this->user->credit_score-$main_data['deal_credit_score']>=0){
                $main_data['pay_credit_score']=$main_data['deal_credit_score'];
                $this->user->credit_score-=$main_data['pay_credit_score'];
            }else{
                DB::rollBack();
                return CommonService::status_return(false,[],__('messages.order.not_enough_credit_score'));
            }
            if($this->user->coupons_total-$main_data['deal_coupons_number']>=0){
                $main_data['pay_coupons_number']=$main_data['deal_coupons_number'];
                $this->user->coupons_total-=$main_data['pay_coupons_number'];
            }else{
                DB::rollBack();
                return CommonService::status_return(false,[],__('messages.order.not_enough_coupons'));
            }


            $main_result=CommonService::store(Order::class,$main_data);
            if(!$main_result['status']){
                DB::rollBack();
                return $main_result;
            }
            $main_order=$main_result['data'];
        }
        //循环子订单
        $no=0;
        foreach($cart['detail'] as $sub_order){
            //创建订单
            $sub_order_no="";
            if(!is_null($main_order)){
                $sub_order_no.="-{$no}";
                //如果有主订单

            }else{
                $sub_order_no=Order::makeOrderNo($this->user->id);
                //不存在主订单 扣除代币 并记录
            }
            $sub_order_data=[
                'order_number'=>$sub_order_no,
                'is_main'=>false,
                'user_id'=>$this->user->id,
                'address_id'=>$address->id,
                'shipping_methods'=>$sub_order['summary']['shipping']->id,
                'order_money'=>$sub_order['summary']['amount'],
                'deal_money'=>$sub_order['summary']['cash_total'],
                'pay_money'=>0,
                'deal_credit_score'=>$sub_order['summary']['credit_score_total']??0,
                'pay_credit_score'=>0,
                'deal_coupons_number'=>$sub_order['summary']['coupons_total']??0,
                'pay_coupons_number'=>0,
                'shipping_fee'=>$sub_order['summary']['shipping_fee']??0,
                'store_type'=>$sub_order['store']->type,
                'store_id'=>$sub_order['store']->id,
                'remark'=>'',
            ];

            if(!is_null($main_order)){
                //如果存在主订单   不需要扣除代币  只需要记录
                //扣除商品代币部分
                if($this->user->credit_score-$sub_order_data['deal_credit_score']>=0){
                    $sub_order_data['pay_credit_score']=$sub_order_data['deal_credit_score'];
                    //积分扣除记录
                    $this->user->log_score(ScoreRecord::SCORE_CREDIT,ScoreRecord::EVENT_DEDUCT,$sub_order_data['pay_credit_score']);
                }
                if($this->user->coupons_total-$sub_order_data['deal_coupons_number']>=0){
                    $sub_order_data['pay_coupons_number']=$sub_order_data['deal_coupons_number'];
                    //代金券扣除记录
                    $this->user->log_coupon(CouponsRecord::EVENT_DEDUCT,$sub_order_data['pay_coupons_number']);
                }
            }else{
                //如果不存在主订单   需要扣除代币
                //扣除商品代币部分
                if($this->user->credit_score-$sub_order_data['deal_credit_score']>=0){
                    $sub_order_data['pay_credit_score']=$sub_order_data['deal_credit_score'];
                    $this->user->credit_score-=$sub_order_data['pay_credit_score'];
                    //积分扣除记录
                    $this->user->log_score(ScoreRecord::SCORE_CREDIT,ScoreRecord::EVENT_DEDUCT,$sub_order_data['pay_credit_score']);
                }else{
                    DB::rollBack();
                    return CommonService::status_return(false,[],__('messages.order.not_enough_coupons'));
                }

                if($this->user->coupons_total-$sub_order_data['deal_coupons_number']>=0){
                    $sub_order_data['pay_coupons_number']=$sub_order_data['deal_coupons_number'];
                    $this->user->coupons_total-=$sub_order_data['pay_coupons_number'];
                    //代金券扣除记录
                    $this->user->log_coupon(CouponsRecord::EVENT_DEDUCT,$sub_order_data['pay_coupons_number']);
                }else{
                    DB::rollBack();
                    return CommonService::status_return(false,[],__('messages.order.not_enough_coupons'));
                }
            }

            $order_result=CommonService::store(Order::class,$sub_order_data,$main_order);
            if(!$order_result['status']){
                DB::rollBack();
                return $order_result;
            }
            $order=$order_result['data'];

            //增加订单商品
            foreach($sub_order['goods'] as $goods){
                $order_goods_data=[
                    'goods_id'=>$goods->goods_id,
                    'goods_type'=>$goods->goods_type,
                    'pricing_schemes'=>$goods->pricing_schemes,
                    'number'=>$goods->number,
                    'subtotal'=>$goods->total_price,
                    'goods_snapshot'=>$goods->goods
                ];
                $order_goods_result=CommonService::store(OrderGoods::class,$order_goods_data,$order->order_goods());
                if(!$order_goods_result['status']){
                    DB::rollBack();
                    return $order_goods_result;
                }
                $delete_result=CommonService::delete($goods);       //删除已经加入订单的购物车
                if(!$delete_result['status']){
                    DB::rollBack();
                    return $order_goods_result;
                }
            }

            $user_change_result=CommonService::update($this->user,[]);
            if(!$user_change_result['status']){
                DB::rollBack();
                return $user_change_result;
            }

            $no++;
        }

        //订单创建完成
        if(!is_null($main_order)){
            $response=$main_result;
        }else{
            $response=$order_result;
        }
        DB::commit();
        return $response;
    }


    /**
     * 订单付款
     * @param $idOrNo
     * @return array
     */
    public static function pay($idOrNo,$paid_amount=0,$pay_type=Order::PAY_TYPE_GOLD_SCORE){
        $order=Order::where('id',$idOrNo)->orWhere('order_number',$idOrNo)->first();
        if(is_null($order)){
            return CommonService::status_return(false,[],"messages.order.not_found");
        }
        $paid_time=Carbon::now()->format('Y-m-d H:i:s');
        DB::beginTransaction();
        if($order->deal_money==$paid_amount){
            //如果付款金额与订单应付金额相等  标记订单为已付款  修改订单已付金额  记录付款方式
            $data=[
                'pay_money'=>$order->deal_money,
                'status'=>Order::STATUS_WAIT_SHIP,
                'pay_type'=>$pay_type,
                'paid_at'=>$paid_time
            ];
            $order_result=CommonService::update($order,$data);
            if(!$order_result['status']){
                DB::rollBack();
                return $order_result;
            }

            //判断订单是否为主订单  如果是主订单  循环付款所有子订单
            if($order->is_main&&$order->sub_order){
                foreach($order->sub_order as $sub_order){
                    $data=[
                        'pay_money'=>$sub_order->deal_money,
                        'status'=>Order::STATUS_WAIT_SHIP,
                        'pay_type'=>$pay_type,
                        'paid_at'=>$paid_time
                    ];
                    $sub_result=CommonService::update($sub_order,$data);
                    if(!$sub_result['status']){
                        DB::rollBack();
                        return $sub_result;
                    }
                }
            }
        }
        DB::commit();
        return CommonService::status_return(true,[],__('messages.order.order_paid'));
    }


    public function query($param=[]){
        //获取订单
        $order=$this->user->orders();
        if(isset($param['status'])){
            $order=$order->where("status",$param['status']);
        }
        if(isset($param['order'])){
            //排序
            $order=$order->orderBy($param['order'],$param['sort']);
        }
        $orders=$order->paginate();
        return CommonService::status_return(true,$orders);
    }

    public static function receive(Order $order){

        $shipment=$order->shipment()->shipped()->orderBy('updated_at','desc')->first();
        if(!is_null($shipment)&&$$order->status==Order::STATUS_WAIT_RECEIVE){
            //收货
            $result=CommonService::update($order,['status'=>Order::STATUS_WAIT_COMMENT]);
            if(!$result['status']){
                return $result;
            }
            $result['msg']=__('messages.order.receive_success');
            //开始生成分润等
            $order=$result['data'];


        }

        return CommonService::status_return(false,[],__('messages.order.receive_failure'));
    }



}