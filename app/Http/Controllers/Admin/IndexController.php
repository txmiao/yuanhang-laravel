<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    /**
     * 首页看板
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index.index');
    }

    /**
     * 清除所有缓存
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function flush()
    {
        if (Cache::flush()) {
            return self::success('清除缓存成功');
        }
        return self::error('清除缓存失败');
    }

    /**
     * 修改配置文件
     * @return string
     * @throws \Throwable
     */
    public function profile()
    {
        $profile = Auth::guard('admin')->user();
        return view('admin.index.profile', compact('profile'))->render();
    }

    /**
     * 更新配置文件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function updateProfile(Request $request)
    {
        $profile = Auth::guard('admin')->user();
        if ($profile->where([
            ['email', $request->input('email')],
            ['id', '<>', $request->input('id')]
        ])->count()) {
            return self::error('该邮箱已存在');
        }
        $profile->fill($request->except('headimgurl', 'password'));

        //如果存在图片上传
        if ($request->hasFile('headimgurl') && $request->file('headimgurl')->isValid()) {
            $profile->old_headimgurl = $profile->headimgurl;
            $filename = $request->file('headimgurl')->store('admin');
            if ($filename) {
                $profile->headimgurl = $filename;
                Storage::exists($profile->old_headimgurl) && Storage::delete($profile->old_headimgurl);
                unset($profile->old_headimgurl);
            }
        }

        if (!is_null($request->input('password'))) {
            $profile->password = bcrypt($request->input('password'));
        }

        if ($profile->save()) {
            return self::success('更新个人配置成功');
        }
        return self::error('更新个人配置失败');

    }

}
