<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ServiceTipRequest;
use App\Models\ServiceTip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceTipController extends Controller
{
    /**
     * 服务保障说明列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = ServiceTip::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.service_tip.index', compact('lists', 'params'));
    }

    /**
     * 添加服务保障说明
     * @param ServiceTipRequest $request
     * @param ServiceTip $serviceTip
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ServiceTipRequest $request, ServiceTip $serviceTip)
    {
        $serviceTip->fill($request->all());
        if ($request->hasFile('icon_upload') && $request->file('icon_upload')->isValid()) {
            $filename = $request->file('icon_upload')->store('service_tips_icon_image');
            $filename && $serviceTip->icon = $filename;
        }
        if ($serviceTip->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑服务保障说明
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = ServiceTip::findOrFail($id);
        return view('admin.service_tip.edit', compact('info'))->render();
    }

    /**
     * 更新服务保障说明
     * @param ServiceTipRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ServiceTipRequest $request)
    {
        $serviceTip = ServiceTip::findOrFail($request->input('id'));
        $serviceTip->fill($request->all());
        if ($request->hasFile('icon_upload') && $request->file('icon_upload')->isValid()) {
            $filename = $request->file('icon_upload')->store('service_tips_icon_image');

            //删除旧图片
            \Storage::exists($serviceTip->icon) && \Storage::delete($serviceTip->icon);

            $filename && $serviceTip->icon = $filename;
        }
        if ($serviceTip->save()) {
            return self::success();
        }
        return self::error();
    }

    public function destroy($id)
    {
        return self::error('暂未开放此功能');
    }

}
