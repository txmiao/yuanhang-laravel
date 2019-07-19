<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\LoginLog;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * 管理员列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::all();

        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Admin::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return self::success('新增管理员成功', $lists);
//        return view('admin.admin.index', compact('lists', 'params', 'roles'));
    }

    /**
     * 添加管理员
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(AdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $admin = new Admin();
        $admin->headimgurl = 'admin/default.png'; //默认用户头像
        $admin->fill($data);
        if ($admin->save()) {
            $admin->roles()->attach($request->input('role_id'));
            return self::success('新增管理员成功');
        }
        return self::error('新增管理员失败');
    }

    /**
     * 编辑管理员
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $admin = Admin::with('roles')->find($id);
        $admin['roles_all'] = Role::all();
        return self::success('查询成功', $admin);
    }

    /**
     * 更新管理员
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function update(AdminRequest $request)
    {
        $admin = Admin::find($request->input('id'));
        if ($admin->where([
            ['email', $request->input('email')],
            ['id', '<>', $request->input('id')]
        ])->count()) {
            return self::error('该邮箱已存在');
        }
        $admin->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $admin->password = bcrypt($request->input('password'));
        }
        if ($admin->save()) {
            $admin->roles()->sync($request->input('role_id'));
            return self::success('修改管理员成功');
        }
        return self::error('修改管理员失败');
    }

    /**
     * 删除管理员
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        LoginLog::where('user_id', $id)->delete();
        if ($admin->delete()) {
            $admin->roles()->sync([]);
            return self::success('删除管理员成功');
        }
        return self::error('删除管理员失败');
    }

    /**
     * 创建激活码
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCode($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin->active_code) {
            return self::error('您已经生成激活码了，不能重复生成');
        }
        $admin->active_code = strtoupper(str_random(8));
        if ($admin->save()) {
            return self::success('激活码创建成功');
        }

        return self::error('操作失败，请稍后重试！');
    }
}
