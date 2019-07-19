<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PartnerLevelRequest;
use App\Models\PartnerGoods;
use App\Models\PartnerLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerLevelController extends Controller
{
    private $partnerGoods;

    public function __construct(PartnerGoods $partnerGoods)
    {
        $this->partnerGoods = $partnerGoods::pluck('name', 'sku_number');
    }

    /**
     * 合伙人等级列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $partnerGoods = $this->partnerGoods;
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = PartnerLevel::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.partner_level.index', compact('lists', 'params', 'partnerGoods'));
    }

    /**
     * 添加合伙人等级
     * @param PartnerLevelRequest $partnerLevelRequest
     * @param PartnerLevel $partnerLevel
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PartnerLevelRequest $partnerLevelRequest, PartnerLevel $partnerLevel)
    {
        $skuNumber = trim_array_null_item($partnerLevelRequest->input('sku_number'));
        $partnerLevel->fill(array_merge($partnerLevelRequest->except('sku_number'), [
            'sku_number' => $skuNumber,
            'name' => PartnerLevel::$levels[$partnerLevelRequest->input('level')],
        ]));
        if ($partnerLevel->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑合伙人等级
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $partnerGoods = $this->partnerGoods;
        $info = PartnerLevel::findOrFail($id);
        return view('admin.partner_level.edit', compact('info', 'partnerGoods'))->render();
    }

    /**
     * 更新合伙人等级
     * @param PartnerLevelRequest $partnerLevelRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PartnerLevelRequest $partnerLevelRequest)
    {
        $partnerLevel = PartnerLevel::findOrFail($partnerLevelRequest->input('id'));
        $skuNumber = trim_array_null_item($partnerLevelRequest->input('sku_number'));
        $partnerLevel->fill(array_merge($partnerLevelRequest->except('sku_number'), [
            'sku_number' => $skuNumber,
            'name' => PartnerLevel::$levels[$partnerLevelRequest->input('level')],
        ]));
        if ($partnerLevel->save()) {
            return self::success();
        }
        return self::error();
    }

    public function destroy($id)
    {
        return self::error('暂未开放此功能');
    }

}
