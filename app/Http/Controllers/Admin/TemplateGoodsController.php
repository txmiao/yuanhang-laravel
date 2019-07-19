<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TemplateGoodsRequest;
use App\Models\Supplier;
use App\Models\TemplateGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateGoodsController extends Controller
{
    private $suppliers;

    public function __construct(Supplier $supplier)
    {
        $this->suppliers = $supplier->pluck('name', 'id');
    }

    /**
     * 商品模板库列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $suppliers = $this->suppliers;
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = TemplateGoods::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.template_goods.index', compact('lists', 'params', 'suppliers'));
    }

    /**
     * 添加模板商品
     * @param TemplateGoodsRequest $templateGoodsRequest
     * @param TemplateGoods $templateGoods
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TemplateGoodsRequest $templateGoodsRequest, TemplateGoods $templateGoods)
    {
        $templateGoods->build_data($templateGoodsRequest, $templateGoods);
        if ($templateGoods->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑模板商品
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $suppliers = $this->suppliers;
        $info = TemplateGoods::findOrFail($id);
        return view('admin.template_goods.edit', compact('suppliers', 'info'))->render();
    }

    /**
     * 更新模板商品
     * @param TemplateGoodsRequest $templateGoodsRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TemplateGoodsRequest $templateGoodsRequest)
    {
        $templateGoods = TemplateGoods::findOrFail($templateGoodsRequest->input('id'));
        $templateGoods->build_data($templateGoodsRequest, $templateGoods);
        if ($templateGoods->save()) {
            return self::success();
        }

        return self::error();
    }

    /**
     * 删除模板商品
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (TemplateGoods::destroy($id)) {
            return self::success();
        }
        return self::error();
    }
}
