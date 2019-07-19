<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * ajax成功返回
     * @param $msg
     * @param null $data
     * @param bool $jump
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($msg = '操作成功', $data = null, $jump = true)
    {
        return self::ajaxReturn(true, $msg, $data, null, $jump);
    }

    /**
     * ajax失败返回
     * @param $msg
     * @param null $field
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($msg = '操作失败，请稍后重试！', $field = null)
    {
        return self::ajaxReturn(false, $msg, null, $field, false);
    }

    /**
     * 组装ajax返回数据
     * @param $status
     * @param null $msg
     * @param null $data
     * @param null $field
     * @param bool $jump
     * @return \Illuminate\Http\JsonResponse
     */
    protected static function ajaxReturn($status, $msg = null, $data = null, $field = null, $jump = true)
    {
        $data = ['code' => -1, 'status' => $status, 'msg' => $msg, 'data' => $data, 'field' => $field, 'jump' => $jump];
        $status and $data['code'] = 20000;
        return response()->json($data);
    }

    /**
     * 去除request空值
     * @param Request $request
     * @return array
     */
    public function trim_null_item(Request $request): array
    {
        $except = [];
        if (count($request->all())) {
            foreach ($request->all() as $k => $item) {
                is_null($item) && array_push($except, $k);
            }
        }
        return $request->except($except);
    }
}
