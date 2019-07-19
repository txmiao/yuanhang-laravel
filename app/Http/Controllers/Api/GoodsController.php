<?php

namespace App\Http\Controllers\Api;

use App\Services\GoodsService;
use App\Transformers\GoodsTransformer;
use Dingo\Api\Http\Request;

class GoodsController extends Controller
{

    /**
     * 商品列表请求
     * @param Request $req
     * @param GoodsService $goodsService
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $req,GoodsService $goodsService){
        $goodsService->setUser($this->user());

        //获取商品类型

        $param['type']=$req->get('type',"default");
        $param['order']=$req->get('order','created_at');
        $param['sort']=$req->get('sort','desc');
        $param['cat']=$req->get('cat',0);
        $param['keywords']=$req->get('keywords',"");

        $goods=$goodsService->query($param);

        return $this->response->paginator($goods,$goodsService->tranformer());
    }


    /***
     * 商品详情
     * @param Request $req
     * @param GoodsService $goodsService
     * @return \Dingo\Api\Http\Response
     */
    public function show(Request $req,GoodsService $goodsService){
        $param['type']=$req->get('type','default');
        $param['id']=$req->get('id',0);

        $goods=$goodsService->find($param);

        return $this->response->item($goods,$goodsService->tranformer());
    }
}
