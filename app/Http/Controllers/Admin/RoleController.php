<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * 角色列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//
//        $permission = array_chunk(Permission::all()->toArray(), 5);
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Role::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return self::success('查询成功', $lists);
    }

    /**
     * 添加角色
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(RoleRequest $request)
    {
        $role = new Role;
        $role->fill($request->all());
        if ($role->save()) {
            $role->perms()->sync($request->input('perm_id', []));
            $data['id'] = $role['id'];
            return self::success('添加角色成功',$data);
        }
        return self::error('添加角色失败');
    }

    /**
     * 编辑角色
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        $array = $role->permissions->toArray();


        
        $array = array_pluck($array, 'id');


        if ($role) {
            return self::success('查询成功', $array);
        } else {
            return self::error('没有该角色');
        }


    }

    /**
     * 更新角色
     * @param RoleRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function update(RoleRequest $request)
    {
        $role = Role::find($request->input('id'));

        if ($role->where('id', '<>', $request->input('id'))
            ->Where(function ($query) use ($request) {
                $query->where('name', $request->input('name'))->orWhere('display_name', $request->input('display_name'));
            })->count()) {
            return self::error('该角色或名称已存在');
        }
        $role->fill($request->all());

        if ($role->save()) {
            $role->perms()->sync($request->input('perm_id', []));
            return self::success('修改角色成功');
        }
        return self::error('修改角色失败');
    }

    /**
     * 全部权限---新增角色用
     */
    public function permission()
    {

        $permission = Permission::all()->toArray();
        return self::success('查询成功', $permission);


    }

    /**
     * 删除角色
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        if ($role->delete()) {
            $role->users()->sync([]);
            $role->perms()->sync([]);
            return self::success('删除角色成功');
        }
        return self::error('删除角色失败');
    }
}
