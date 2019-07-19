<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckAdminLogin
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
        if (!Auth::guard('admin')->check()) {
            //使用guest而不用to,route，在重定向时会将当前url保存到session中，
            //这样可以在登陆以后，使用Redirect::intended()方法跳转到之前的页面继续业务
            return Redirect::guest('manage/login');
        }
        return $next($request);
    }
}
