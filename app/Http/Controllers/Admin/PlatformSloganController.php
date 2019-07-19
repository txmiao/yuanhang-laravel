<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PlatformSloganRequest;
use App\Models\PlatformSlogan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformSloganController extends Controller
{
    /**
     * 平台标语列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = PlatformSlogan::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.platform_slogan.index', compact('lists', 'params'));
    }

    /**
     * 添加平台标语
     * @param PlatformSloganRequest $request
     * @param PlatformSlogan $platformSlogan
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PlatformSloganRequest $request, PlatformSlogan $platformSlogan)
    {
        $platformSlogan->fill($request->all());
        if ($request->hasFile('icon_upload') && $request->file('icon_upload')->isValid()) {
            $filename = $request->file('icon_upload')->store('platform_slogan_icon_image');
            $filename && $platformSlogan->icon = $filename;
        }
        if ($platformSlogan->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑平台标语
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = PlatformSlogan::findOrFail($id);
        return view('admin.platform_slogan.edit', compact('info'))->render();
    }

    /**
     * 更新平台标语
     * @param PlatformSloganRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PlatformSloganRequest $request)
    {
        $platformSlogan = PlatformSlogan::findOrFail($request->input('id'));
        $platformSlogan->fill($request->all());
        if ($request->hasFile('icon_upload') && $request->file('icon_upload')->isValid()) {
            $filename = $request->file('icon_upload')->store('platform_slogan_icon_image');

            //删除旧图片
            \Storage::exists($platformSlogan->icon) && \Storage::delete($platformSlogan->icon);

            $filename && $platformSlogan->icon = $filename;
        }
        if ($platformSlogan->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 删除平台标语
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (PlatformSlogan::destroy($id)) {
            return self::success();
        }
        return self::error();
    }

}
