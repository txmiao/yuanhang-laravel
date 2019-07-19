<?php

namespace App\Http\Controllers\Admin;

use App\Models\PartnerGoods;
use App\Models\ServiceTip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerGoodsController extends Controller
{
    private $serviceTips;

    public function __construct(ServiceTip $serviceTip)
    {
        $this->serviceTips = $serviceTip->whereIn('bind_type', [ServiceTip::BIND_TYPE_ALL, ServiceTip::BIND_TYPE_PARTNER])
            ->pluck('name', 'id');
    }

    /**
     * 合伙人商品列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = PartnerGoods::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.partner_goods.index', compact('lists', 'params'));
    }

    /**
     * 编辑合伙人商品
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $serviceTips = $this->serviceTips;
        $info = PartnerGoods::findOrFail($id);
        return view('admin.partner_goods.edit', compact('info', 'serviceTips'))->render();
    }

    /**
     * 更新合伙人商品
     * @param Request $request
     * @param PartnerGoods $pg
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, PartnerGoods $pg)
    {
        try {
            if ($request->input('pre_discount_price') > 0 && $request->input('pre_discount_price') < $request->input('price')) {
                throw new \Exception('折前价不能低于当前售价');
            }
            $partnerGoods = PartnerGoods::findOrFail($request->input('id'));
            $partnerGoods->fill(array_merge($request->all(), [
                'pricing_schemes' => $pg->build_pricing_schemes($request->input('pricing_schemes'))
            ]));
            if ($partnerGoods->save()) {
                return self::success();
            }
        } catch (\Exception $e) {
            return self::error($e->getMessage() ?? '');
        }
    }

    public function destroy()
    {
        return self::error('暂未开放此功能');
    }
}
