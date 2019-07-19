<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;
use Illuminate\Support\Facades\Auth;

class GenerateMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $list = Menu::select()
            ->orderBy('pid', 'asc')
            ->orderBy('sort', 'desc')
            ->orderBy('created_at', 'asc')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        $menuList = get_tree_list_with_child($list);

        //如果不是超级管理员则需要做权限验证
        if (!Auth::guard('admin')->user()->hasRole('SuperAdmin')) {
            foreach ($menuList as $key => &$val) {

                //释放当前用户没有权限操作的资源
                foreach ($val['child'] as $k => &$v) {
                    if (!Auth::guard('admin')->user()->can($v['permission'])) {
                        unset($val['child'][$k]);
                    }
                }
                unset($v);

                //如果没有子资源则释放这个资源
                if (!count($val['child'])) {
                    unset($menuList[$key]);
                }
            }
            unset($val);

//            dd($menuList);
        }

        view()->share('menu', $menuList); //获取所有菜单的树形结构
        view()->share('currMenu', $request->route()->getName());

        return $next($request);
    }
}
