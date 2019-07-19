<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlatformTemplateGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformTemplateGoodsController extends Controller
{
    /**
     * 平台模板商品库列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = PlatformTemplateGoods::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.platform_template_goods.index', compact('lists', 'params'));
    }

    /**
     * 编辑平台模板商品
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = PlatformTemplateGoods::findOrFail($id);
        return view('admin.platform_template_goods.edit', compact('info'))->render();
    }

    /**
     * 更新平台模板商品
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $platformTemplateGoods = PlatformTemplateGoods::findOrFail($request->input('id'));
        $platformTemplateGoods->fill($request->all());
        if ($platformTemplateGoods->save()) {
            return self::success();
        }
        return self::error();
    }

    public function destroy($id)
    {
        return self::error('暂未开放此功能');
    }
}
