<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AuthenticationRequest;
use App\Http\Requests\Api\AuthorizationRequest;
use App\Http\Requests\Api\SocialAuthorizationRequest;
use App\Models\BlackList;
use App\Models\CoinRecord;
use App\Models\Search;
use App\Models\System;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthorizationsController extends Controller
{
    /**
     * 第三方登录
     * @param $social_type
     * @param SocialAuthorizationRequest $request
     */
    public function socialStore($social_type, SocialAuthorizationRequest $request)
    {
        if (!in_array($social_type, ['weixin'])) {
            return $this->response->errorBadRequest();
        }

        $driver = Socialite::driver($social_type);

        try {
            if ($code = $request->code) {
                $response = $driver->getAccessTokenResponse($code);
                $token = array_get($response, 'access_token');
            } else {
                $token = $request->access_token;

                if ($social_type == 'weixin') {
                    $driver->setOpenId($request->openid);
                }
            }

            $oauthUser = $driver->userFromToken($token);
        } catch (\Exception $e) {
            return $this->response->errorUnauthorized('参数错误，未获取用户信息');
        }

        switch ($social_type) {
            case 'weixin':
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;

                if ($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getId())->first();
                }

                try {
                    if (!$user) {
                        DB::beginTransaction();

                        $user = User::create([
                            'name' => $oauthUser->getNickname(),
                            'avatar' => $oauthUser->getAvatar(),
                            'weixin_openid' => $oauthUser->getId(),
                            'weixin_unionid' => $unionid,
                            'last_actived_at' => Carbon::now(),
                            'last_actived_ip' => $request->ip()
                        ]);
                        DB::commit();
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                break;
        }

        $token = Auth::guard('api')->fromUser($user);

        if ('production' != config('app.env')) {
            Log::info(serialize($oauthUser));
        }

        $user->update([
            'last_actived_at' => Carbon::now(),
            'last_actived_ip' => $request->ip(),
            'sex' => $oauthUser->offsetExists('sex') ? $oauthUser->offsetGet('sex') : null,
            'city' => $oauthUser->offsetExists('city') ? $oauthUser->offsetGet('city') : null,
            'province' => $oauthUser->offsetExists('province') ? $oauthUser->offsetGet('province') : null,
            'country' => $oauthUser->offsetExists('country') ? $oauthUser->offsetGet('country') : null,
//            'avatar' => $oauthUser->getAvatar()
        ]);

        return $this->respondWithToken($token)->setStatusCode(201);
    }

    /**
     * 登录
     * @param AuthorizationRequest $request
     */
    public function store(AuthenticationRequest $request)
    {

        $username = $request->username;
        preg_match("/^1[3456789]\d{9}$/", $username) ?
            $credentials['phone'] = $username :
            $credentials['name'] = $username;
        $credentials['password'] = $request->password;
        $token = Auth::guard('api')->attempt($credentials);

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        $user = Auth::guard('api')->user();
        //登录屏蔽白名单
//        if (User::IN_BLACK_LIST == $user->in_black_list) {
//            return $this->response->errorUnauthorized('系统限制，请联系汇搜平台');
//        }

        $user->last_actived_at = Carbon::now();
        $user->last_actived_ip = $request->ip();
        $user->save();

        return $this->respondWithToken($token)->setStatusCode(200);

    }

    /**
     * 刷新token
     * @return mixed
     */
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * 删除token
     * @return \Dingo\Api\Http\Response
     */
    public function destroy()
    {
        Auth::guard('api')->logout();
        return $this->response->noContent();
    }

    /**
     * 获取token
     * @param $token
     * @return mixed
     */
    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * 注销账号
     * @return \Dingo\Api\Http\Response|void
     */
    public function logoff()
    {
        Log::info('用户 ' . $this->user->name . ' 在 ' . date('Y-m-d H:i:s') . ' 注销了账号...');
        return $this->response->errorForbidden('系统限制，暂未开放注销功能');

        try {
            DB::beginTransaction();
            $user = $this->user();

            //删除专线和中转线路信息
            if (isset($user->company) && count($user->company->transfer_line)) {
                foreach ($user->company->transfer_line as &$item) {
                    $item->delete();
                }
                unset($item);
            }
            if (isset($user->company) && count($user->company->exclusive)) {
                foreach ($user->company->exclusive as &$item) {
                    $item->delete();
                }
                unset($item);
            }

            //删除被收藏公司信息
            if (isset($user->company) && count($user->company->collection)) {
                foreach ($user->company->collection as &$item) {
                    $item->delete();
                }
                unset($item);
            }

            //删除浮动广告
            if (isset($user->company) && count($user->company->float_ad)) {
                foreach ($user->company->float_ad as &$item) {
                    $item->delete();
                }
                unset($item);
            }

            //删除搜索预备数据
            isset($user->company) && Search::where('company_id', $user->company->id)->delete();

            //删除子公司信息
            if (isset($user->company) && count($user->company->company_subs)) {
                foreach ($user->company->company_subs as &$item) {
                    $item->delete();
                }
                unset($item);
            }

            //删除公司扩展信息
            if (isset($user->company) && count($user->company->company_ext)) $user->company->company_ext->delete();

            //删除公司相册信息
            if (isset($user->company) && count($user->company->company_galleries)) $user->company->company_galleries->delete();

            //删除公司基础数据
            if (isset($user->company) && count($user->company->company_base_data)) $user->company->company_base_data->delete();

            //删除公司信息
            if (isset($user->company) && count($user->company)) $user->company->forceDelete();

            //删除个人/公司认证信息
            if (count($user->authentication)) $user->authentication->delete();

            //删除充值记录
            if (count($user->charge_record)) {
                foreach ($user->charge_record as &$item) {
                    $item->delete();
                }
                unset($item);
            };

            //删除消息记录
            if (count($user->messages)) {
                foreach ($user->messages as &$item) {
                    $item->delete();
                }
                unset($item);
            };

            //删除留言记录
            if (count($user->guest_book)) {
                foreach ($user->guest_book as &$item) {
                    $item->delete();
                }
                unset($item);
            };

            //删除图片资源信息
            if (count($user->images)) {
                foreach ($user->images as &$item) {
                    $item->delete();
                }
                unset($item);
            };

            //删除黑名单
            BlackList::where([
                ['type', BlackList::TYPE_USER],
                ['value', $user->id]
            ])->delete();

            //删除用户收藏记录
            if (count($user->collection)) {
                foreach ($user->collection as &$item) {
                    $item->delete();
                }
                unset($item);
            };

            //强制删除用户信息
            $user->forceDelete();

            DB::commit();
            return $this->response->noContent();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->response->errorForbidden($exception->getMessage() ?? '注销失败，请稍后重试');
        }
    }
}
