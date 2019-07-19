<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * 广告列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
            'status' => $request->input('status', ''),
        ];
        $lists = Ad::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->when($params['status'], function ($query) use ($params) {
                return $query->where('status', $params['status']);
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.ad.index', compact('lists', 'params'));
    }

    /**
     * 添加广告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $ad = new Ad($request->all());

        if ($request->hasFile('image_upload') && $request->file('image_upload')->isValid()) {
            $filename = $request->file('image_upload')->store('ad_image');
            $filename && $ad->image = $filename;
        }

        if ($ad->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑广告
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $ad = Ad::findOrFail($id);
        return view('admin.ad.edit', compact('ad'))->render();
    }

    /**
     * 更新广告
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $ad = Ad::findOrFail($request->id);
        $ad->fill($request->all());

        if ($request->hasFile('image_upload') && $request->file('image_upload')->isValid()) {
            $filename = $request->file('image_upload')->store('ad_image');
            Storage::exists($ad->image) && Storage::delete($ad->image);
            $filename && $ad->image = $filename;
        }

        if ($ad->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 删除广告
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        if ($ad->delete()) {
            Storage::exists($ad->image) && Storage::delete($ad->image);
            return self::success();
        }
        return self::error();
    }
}
