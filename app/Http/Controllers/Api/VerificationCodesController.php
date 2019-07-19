<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodesRequest;
use Illuminate\Support\Facades\Cache;
use JiGuang\JSMS;

class VerificationCodesController extends Controller
{
    /**
     * 发送短信验证码
     * @param VerificationCodesRequest $request
     * @return mixed
     */
    public function store(VerificationCodesRequest $request)
    {
        $phone = $request->phone;

        //生成4位随机数，左侧补0
        if (!app()->environment('production')) {
            $msg_id = '';
        } else {
            try {
                $client = new JSMS(config('jiguang.app_key'), config('jiguang.master_secret'), ['disable_ssl' => true]);
                $res = $client->sendCode($phone, 154600);
                if (!isset($res['body']['msg_id'])) {
                    throw new \Exception('发送失败');
                }
                $msg_id = $res['body']['msg_id'];
            } catch (\Exception $exception) {
                return $this->response->errorBadRequest($exception->getMessage() ?? '发送失败，请稍后重试！');
            }
        }

        $key = 'verificationCode_' . str_random(15);
        $expiredAt = now()->addMinute(10);

        //缓存验证码，10分钟过期
        Cache::put($key, ['phone' => $phone, 'msg_id' => $msg_id], $expiredAt);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString()
        ])->setStatusCode(201);
    }
}
