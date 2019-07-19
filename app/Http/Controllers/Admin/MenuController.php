<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * 资源列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Menu::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->with(['belongsToParent'])
            ->orderBy('pid', 'asc')
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
//        $pid = Menu::where('pid', 0)->get();
//        $lists->prev_page_url = $pid;
        return self::success('查询成功', $lists);
    }


    /**
     * 顶级资源列表
     */
    public function topmenu()
    {

        $pid = Menu::where('pid', 0)->get();
        $pid = json_decode(json_encode($pid), true);

        if (!empty($pid)) {
            $pid[0]['id'] = 0;
            $pid[0]['name'] = '顶级资源';
        } else {
            return self::error('查询失败');
        }
        $pidc = Menu::where('pid', 0)->get();

        $a = json_decode(json_encode($pid), true);
        $b = json_decode(json_encode($pidc), true);
        $obj = (object)array_merge((array)$a, (array)$b);
        return self::success('查询成功', $obj);
    }

    /**
     * 添加资源
     * @param MenuRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(MenuRequest $request)
    {

        $menu = new Menu;
        $menu->name = $request->get('name');
        $menu->link = $request->get('link');
        $menu->permission = $request->get('permission');
        $menu->pid = $request->get('pid', 0);
        $menu->icon = $request->get('icon');
        $menu->sort = $request->get('sort', 0);
        $menu->path = $request->get('path');
        $menu->component = $request->get('component');
        $menu->v_name = $request->get('v_name');
        $menu->redirect = $request->get('redirect');
        $menu->title = $request->get('title');

        $title = $request->get('title');
        if (!empty($title)) {
            $data['title'] = $title;
        }
        $icon = $request->get('icon');

        if (!empty($icon)) {
            $data['icon'] = $icon;
        }
        if (!empty($title) or !empty($icon)) {
            $menu->meta = json_encode($data);
        }
        $p = $request->get('permission');


        if (!empty($p)) {
            $permission_id = DB::table('permissions')->where('name', $p)->value('id');

            if (!$permission_id) {
                return self::error('添加资源失败,权限错误');
            }
            $menu->permission_id = $permission_id;
        }
        if ($menu->save()) {
            $pidt = $request->get('pid');
            $menudata = $menu->where('id', $pidt)->value('name');

            $data['id'] = $menu['id'];
            $data['created_at'] = $menu['created_at'];
            if (!empty($pidt)) {
                $data['belongs_to_parent']['id'] = $pidt;
                $data['belongs_to_parent']['name'] = $menudata;
            }


            return self::success('添加资源成功', $data);
        }
        return self::error('添加资源失败');
    }

    /**
     * 编辑资源
     * @param $id
     * @return string
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $pid = Menu::where('pid', 0)->get();
        $menu['pid'] = $pid;
        if ($menu) {
            return self::success('查询成功', $menu);
        } else {
            return self::error('没有该角色');
        }
    }

    /**
     * 更新资源
     * @param MenuRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function update(MenuRequest $request)
    {

        $menu = Menu::find($request->input('id'));

        if ($menu->where([
            ['name', $request->input('name')],
            ['id', '<>', $request->input('id')]
        ])->count()) {
            return self::error('该资源名称已存在');
        }
        $p = $request->get('permission');

        if (!empty($p)) {
            $permission_id = DB::table('permissions')->where('name', $p)->value('id');
            if (!$permission_id) {
                return self::error('添加资源失败,权限错误');
            }
            $menu->permission_id = $permission_id;
        }

        $menu->fill($request->all());
        $title = $request->get('title');
        if (!empty($title)) {
            $data['title'] = $title;
        }
        $icon = $request->get('icon');

        if (!empty($icon)) {
            $data['icon'] = $icon;
        }
        if (!empty($title) or !empty($icon)) {
            $menu->meta = json_encode($data);
        }
        unset($menu->belongs_to_parent);
        if ($menu->save()) {
            return self::success('修改资源成功');
        }
        return self::error('修改资源失败');
    }

    /**
     * 删除资源
     * @param $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $tips = '';
        if ($menu->delete()) {
            if (0 == $menu->pid) {
                $menu->where('pid', $menu->id)->update(['pid' => 0]);
                $tips = "<br/>该资源下所有子资源已转换为顶级资源";
            }
            return self::success('删除资源成功' . $tips);
        }
        return self::error('删除资源失败');
    }


}
