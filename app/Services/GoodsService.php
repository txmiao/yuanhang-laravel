<?php
/**
 * Created by PhpStorm.
 * User: leetotti
 * Date: 2019/5/17
 * Time: 16:45
 */

namespace App\Services;


use App\Models\PartnerGoods;
use App\Models\PartnerLevel;
use App\Transformers\PartnerGoodsTransformer;
use App\Transformers\PartnerStoreTransformer;
use Illuminate\Support\Facades\DB;

class GoodsService
{
    protected $goodsModel;
    private $user;
    private $query;

    public function setUser($user=null){
        $this->user=$user;
    }

    protected function setGoodsModel(&$param){
        switch($param['type']){
            case  "partner":
                $this->goodsModel=PartnerGoods::class;
                break;
            case "upgrade":
                $this->goodsModel=PartnerGoods::class;
                //需要先获取到用户的合伙人等级  根据用户合伙人等级获取比他等级高的商品
                $result=$this->user->is_partner();
                if($result['status']){
                    //是合伙人 获取更高级合伙人
                    $levels=PartnerLevel::where('sort','>',$result['data']->sort)->pluck('sku_number')->toArray();
                }else{
                    //不是合伙人 获取所有合伙人商品
                    $levels=PartnerLevel::pluck('sku_number')->toArray();
                }
                $skus=[];
                foreach($levels as $level){
                    if(count($level)>0){
                        foreach($level as $key=>$sku){
                            if(count($sku)>0){
                                foreach($sku as $a){
                                    array_push($skus,$a);
                                }
                            }
                        }
                    }
                }
                $param['sku']=array_unique($skus);

                break;
        }
        unset($param['type']);
    }

    public function query($param){
        $this->setGoodsModel($param);
        $goods=$this->goodsModel::where(function($query)use($param){
            //分类
            if(!empty($param['cat'])){
                if(is_array($param['cat'])){
                    $query->whereIn('cat',$param['cat']);
                }else{
                    $query->where('cat',$param['cat']);
                }
            }
            //关键词
            if(!empty($param['keywords'])){
                $query->where('name','like',"%{$param['keywords']}%");
            }
            //sku
            if(!empty($param['sku'])){
                if(is_array($param['sku'])){
                    $query->whereIn('sku_number',$param['sku']);
                }else{
                    $query->where('sku_number','like',"%{$param['sku']}%");
                }
            }
        })->orderBy($param['order'],$param['sort'])->paginate();

        return $goods;
    }


    public function tranformer(){
        switch($this->goodsModel){
            case PartnerGoods::class:

                return new PartnerGoodsTransformer();
                break;
        }
    }

    public function find($param){
        $this->setGoodsModel($param);
        $goods=$this->goodsModel::find($param['id']);
        return $goods;
    }
}