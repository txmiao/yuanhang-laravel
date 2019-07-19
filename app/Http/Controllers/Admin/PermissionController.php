<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionRequest;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * 权限列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Permission::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return self::success('查询成功', $lists);
    }

    /**
     * 添加权限
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission();
        $permission->fill($request->all());
        if ($permission->save()) {
            $data['id'] = $permission['id'];
            $data['created_at'] = $permission['created_at'];
            return self::success('添加权限成功',$data);
        }
        return self::error('添加权限失败');
    }

    /**
     * 编辑权限
     * @param $id
     * @return string
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            return self::success('查询成功', $permission);
        } else {
            return self::error('没有该角色');
        }
    }

    /**
     * 更新权限
     * @param PermissionRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function update(PermissionRequest $request)
    {
        $permission = Permission::find($request->input('id'));
        if ($permission->where([
            ['name', $request->input('name')],
            ['id', '<>', $request->input('id')]
        ])->count()) {
            return self::error('该权限已存在');
        }

        $permission->fill($request->all());
        if ($permission->save()) {
            return self::success('更新权限成功');
        }
        return self::error('更新权限失败');

    }

    /**
     * 删除权限
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id)
    {
        if (Permission::destroy($id)) {
            return self::success('删除权限成功');
        }
        return self::error('删除权限失败');
    }
}
