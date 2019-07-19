<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class WeChatController extends Controller
{
    /**
     * 微信与服务器对接
     * @return mixed
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
       
        $app->server->push(function ($message) use ($app) {
            if ($message['MsgType'] == 'event') {
                if ($message['Event'] == 'subscribe') {
                    $userInfo = $app->user->get($message['FromUserName']);
                    Log::info($userInfo);
                    return "欢迎关注微雪！";
                } elseif ($message['Event'] == 'unsubscribe') {
                    //
                }
            }
        });

        return $app->server->serve();
    }
}
