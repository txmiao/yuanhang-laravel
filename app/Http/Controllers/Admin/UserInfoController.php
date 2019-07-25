<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    /**
     * 添加用户详情
     */
    public function store(Request $request)
    {

        $userinfo = new UserInfo($request->all());
        if ($userinfo->save()) {
            return self::success('添加用户详情成功');
        }
        return self::error('添加用户详情失败！');

    }

    /**
     * 查看用户详情
     */
    public function edit($id)
    {
        $user_info = UserInfo::where('user_id',$id)->first();
        return self::success('查找用户详情成功',$user_info);

    }

    /**
     * 更新用户详情
     */
    public function update(Request $request)
    {
        $user_info = UserInfo::findOrFail($request->id);
        $user_info->fill($request->all());
        if ($user_info->save()) {
            return self::success('更新成功');
        }
        return self::error('更新失败');


    }
}
