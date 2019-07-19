<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AuthenticationRequest;
use App\Models\Authentication;
use App\Models\AuthRecordByYsePay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    /**
     * 实名认证申请记录列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            'status' => $request->input('status', ''),
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Authentication::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->whereHas('user', function ($query) use ($params) {
                    $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
                });
            })
            ->when($params['status'], function ($query) use ($params) {
                return $query->where('status', $params['status']);
            })
            ->orderBy('status')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.authentication.index', compact('lists', 'params'));
    }

    /**
     * 编辑实名认证申请记录
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = Authentication::findOrFail($id);
        $info->load(['auth_record_by_yse_pay' => function ($query) {
            $query->where('order_status', 'success');
        }]);
        return view('admin.authentication.edit', compact('info'))->render();
    }

    /**
     * 更新实名认证申请
     * @param AuthenticationRequest $request
     * @param AuthRecordByYsePay $authRecordByYsePay
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AuthenticationRequest $request, AuthRecordByYsePay $authRecordByYsePay)
    {
        $verifyData = [];
        try {
            \DB::beginTransaction();
            $authentication = Authentication::findOrFail($request->input('id'));
            if (
                Authentication::STATUS_WAIT_AUDIT == $authentication->status
                && Authentication::STATUS_PASS == $request->input('status')
            ) {
                //调用银盛实名认证接口
                $verifyData = $authRecordByYsePay->verify_facticity($authentication);

                //校验签名
                $data = json_encode($verifyData['res'][config('yse_pay.yse_pay_auth_response_name')], JSON_UNESCAPED_SLASHES);
                if ($authRecordByYsePay->sign_check($verifyData['res']['sign'], $data) == true) {
                    throw new \Exception('签名校验失败');
                }

                //接口调用失败
                if (isset($verifyData['res'][config('yse_pay.yse_pay_auth_response_name')]['sub_code'])
                    && isset($verifyData['res'][config('yse_pay.yse_pay_auth_response_name')]['sub_msg'])) {
                    throw new \Exception($verifyData['res'][config('yse_pay.yse_pay_auth_response_name')]['sub_msg']);
                }

                $authentication->user->update([
                    'real_name' => $authentication->real_name,
                    'id_card' => $authentication->id_card_number,
                ]);
            }

            $authentication->fill($this->trim_null_item($request));
            $authentication->save();
            \DB::commit();
            return self::success();

        } catch (\Exception $e) {

            \DB::rollBack();
            return self::error($e->getMessage() ?? '');

        } finally {
            if (isset($verifyData['authData'])) {
                $authRecordByYsePay->fill($verifyData['authData']);
                $authRecordByYsePay->save();
            }
        }
    }
}
