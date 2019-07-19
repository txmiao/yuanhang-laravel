<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Cache;

class CaptchasController extends Controller
{
    /**
     * 创建图片验证码
     *
     * @SWG\Post(path="/api/captchas",
     *   tags={"User"},
     *   summary="获取图片验证码",
     *   description="请求该接口获取图片验证码，通过此接口返回数据来获取短信验证码",
     *   operationId="captchas_store",
     *   produces={"application/json"},
     *   @SWG\Parameter(
     *     in="formData",
     *     name="phone",
     *     type="string",
     *     description="手机号",
     *     required=true,
     *   ),
     *   @SWG\Response(response="default", description="操作成功")
     * )
     *
     * @param CaptchaRequest $request
     * @param CaptchaBuilder $captchaBuilder
     * @return mixed
     */
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . str_random(15);
        $phone = $request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinute(2);
        Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }
}
