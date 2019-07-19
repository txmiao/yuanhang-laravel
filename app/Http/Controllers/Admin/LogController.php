<?php

namespace App\Http\Controllers\Admin;

use App\Models\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * 登录日志列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'location'),
            '_kw' => $request->input('_kw', ''),
        ];

        $lists = LoginLog::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->when(!Auth::guard('admin')->user()->hasRole('SuperAdmin'), function ($query) {
                return $query->where('user_id', Auth::guard('admin')->id());
            })
            ->orderBy('time', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.login_log.index', compact('lists', 'params'));
    }

    /**
     * 删除登录日志
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, $id = null)
    {
        if (LoginLog::whereIn('id', explode(',', $id ?? $request->input('id')))->delete()) {
            return self::success('登录日志删除成功');
        }
        return self::error('登录日志删除失败');
    }
}
