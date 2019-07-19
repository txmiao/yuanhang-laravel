<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ForgetPasswordRequest;
use App\Http\Requests\Api\ModifyPasswordRequest;
use App\Http\Requests\Api\UserRequest;
use App\Models\Image;
use App\Models\Region;
use App\Models\User;
use App\Transformers\UserTransformer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use JiGuang\JSMS;

class UserController extends Controller
{
    /**
     * 用户注册
     * @param UserRequest $request
     * @return $this|void
     */
    public function store(UserRequest $request)
    {
        $verifyData = Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }

        //屏蔽验证码
//        $client = new JSMS(config('jiguang.app_key'), config('jiguang.master_secret'), ['disable_ssl' => true]);
//        if (app()->environment('production')) {
//            $checkRes = $client->checkCode($verifyData['msg_id'], $request->verification_code);
//            if (!$checkRes['body']['is_valid']) {
//                //返回401
//                return $this->response->errorUnauthorized('验证码错误');
//            }
//        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'type' => $request->type,
            'password' => bcrypt($request->password),
            'last_actived_at' => Carbon::now(),
            'last_actived_ip' => $request->ip()
        ]);

        $data['access_token'] = Auth::guard('api')->fromUser($user);
        $data['token_type'] ='Bearer';
        $data['expires_in'] =Auth::guard('api')->factory()->getTTL() * 60;

        return response()->json( ['status' => '200', 'msg' => '注册成功', 'data' => $data] );



        //清除验证缓存
        Cache::forget($request->verification_key);

        return $this->response->item($user, new UserTransformer())
            ->setMeta([
                'access_token' => Auth::guard('api')->fromUser($user),
                'token_type' => 'Bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
            ])
            ->setStatusCode(201);
    }

    /**
     * 获取登录用户信息
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
        $user = $this->user();
        $user->load('collection');
        $redis = Redis::connection('default');
        $remainSecond = Carbon::now()->diffInSeconds(Carbon::tomorrow()); //今日剩余有效时间
        $redis->sadd('active_user', $user->id);
        $redis->expire('active_user', $remainSecond);
        return $this->response->item($user, new UserTransformer());
    }

    /**
     * 更新用户信息
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = $this->user();
        $attributes = $request->all();
        if ($request->city && $request->address) {
            $attributes['full_address'] = (new Region())
                    ->getFullAddress($request->province, $request->get('city', null), $request->get('district', null)) . '·' . $request->address;
        }

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);
            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer());
    }

    /**
     * 忘记密码
     * @param ForgetPasswordRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $verifyData = Cache::get($request->verification_key);
        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }
        $client = new JSMS(config('jiguang.app_key'), config('jiguang.master_secret'), ['disable_ssl' => true]);
        if (app()->environment('production')) {
            if (!$client->checkCode($verifyData['msg_id'], $request->verification_code)) {
                //返回401
                return $this->response->errorUnauthorized('验证码错误');
            }
        }

        User::where('phone', $verifyData['phone'])
            ->update(['password' => bcrypt($request->password)]);

        //清除验证缓存
        Cache::forget($request->verification_key);

        return $this->response->noContent();
    }

    /**
     * 修改密码
     * @param ModifyPasswordRequest $request
     * @param User $user
     * @return \Dingo\Api\Http\Response|void
     */
    public function modifyPassword(ModifyPasswordRequest $request, User $user)
    {
        $user = $this->user();
        $verifyData = Cache::get($request->verification_key);
        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }
        $client = new JSMS(config('jiguang.app_key'), config('jiguang.master_secret'), ['disable_ssl' => true]);
        if (app()->environment('production')) {
            if (!$client->checkCode($verifyData['msg_id'], $request->verification_code)) {
                //返回401
                return $this->response->errorUnauthorized('验证码错误');
            }
        }
        $user->update(['password' => bcrypt($request->password)]);
        return $this->response->noContent();
    }

}
