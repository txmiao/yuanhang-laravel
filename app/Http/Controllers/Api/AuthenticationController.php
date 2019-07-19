<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthenticationRequest;
use App\Models\Authentication;
use App\Models\Image;
use App\Transformers\AuthenticationTransformer;

class AuthenticationController extends Controller
{
    /**
     * 认证详情
     * @param Authentication $authentication
     * @return \Dingo\Api\Http\Response
     */
    public function show(Authentication $authentication)
    {
        $auth = $authentication->where('user_id', $this->user()->id)->first();
        return $this->response->item($auth, new AuthenticationTransformer());
    }


    /**
     * 添加认证信息
     * @param AuthenticationRequest $request
     * @param Authentication $authentication
     * @return \Dingo\Api\Http\Response
     */
    public function store(AuthenticationRequest $request, Authentication $authentication)
    {
        $user = $this->user();
        if ($authentication->where([
            ['user_id', $user->id],
            //['status', '<>', Authentication::STATUS_AUDIT_FAIL]
        ])->count()) {
            return $this->response->errorBadRequest('当前用户已申请过认证');
        }
        try {
            $attributes = $request->all();
            $attributes['user_id'] = $user->id;
            $attributes['status'] = Authentication::STATUS_WAIT_AUDIT;//100待审核  101已通过  102已拒绝
            $attributes = $authentication->data_assembly($request);
            $authentication->updateOrCreate(
                ['user_id' => $user->id],
                $attributes
            );
            return $this->response->noContent();
        } catch (\Exception $e) {
            return $this->response->errorForbidden('添加认证信息失败');
        }
    }
}
