<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\LoginLog;
use App\Models\System;
use function Couchbase\defaultDecoder;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public $maxAttempts; //最大尝试登录次数
    public $decayMinutes; //锁定时长

    public function username()
    {
        return 'name';
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/manage';

    /**
     * LoginController constructor.
     */
//    public function __construct()
//    {
//
//        $this->middleware('guest')->except('logout');
//
//        $this->maxAttempts = System::getConf('max_try_login_times', '5');
//        $this->decayMinutes = System::getConf('lock_time', '1');
//
//    }

    /**
     * 登录界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        config()->set('session.driver', 'array');
//        dd(Auth::guard('admin')->viaRemember());
        if (Auth::guard('admin')->check()) {
            return Redirect::route('index.index');
        }
        $captchaData = $this->createCaptcha();


        return view('admin.auth.login', compact('captchaData'));
    }

    /**
     * 登录
     * @param AdminLoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */

    public function login(Request $request)
    {
//        $datat['code'] = 20000;
//        $datat['data']['token'] = 'adminttt-token';
//        return $datat;
        $credentials['name'] = $request->input('username');
//        return  $credentials['name'];
        $credentials['password'] = $request->input('password');
        $ip = $request->ip();
        $location = get_ip_address($request->ip());
        try {
            if ($token = Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                $admin->ip = $ip;
                $admin->location = $location;
                $admin->save();
                $data['token'] = $token;
                return success($data);
            } else {
                return failMsg('用户名或密码错误');
            }
        } catch (\Exception $e) {
            return failMsg();
        }

    }


    /**
     * 刷新验证码
     * @param Request $request
     * @return array
     */
    public function refreshCaptcha(Request $request)
    {
        //清除验证缓存
        $request->captcha_key && Cache::forget($request->captcha_key);

        return $this->createCaptcha();
    }

    /**
     * 生成验证码
     * @return array
     */
    protected function createCaptcha()
    {
        $captchaKey = 'captcha-' . str_random(15);
        $captcha = (new CaptchaBuilder())->build($width = 165, $height = 45);
        $expiredAt = now()->addMinute(2);
        Cache::put($captchaKey, ['code' => $captcha->getPhrase()], $expiredAt);

        return [
            'captcha' => $captcha->inline(),
            'captcha_key' => $captchaKey
        ];
    }


    /**
     * 退出
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        try {
            Auth::guard('admin')->logout();
            return success();
        } catch
        (\Exception $e) {
            return failMsg();
        }
    }


    /**
     * 后台菜单---树形结构
     */
    public function tree()
    {
        $datat['code'] = 20000;
        $datat['data'][0]['path'] = '/icon';
        $datat['data'][0]['component'] = 'la';
        $datat['data'][0]['children'][0]['path'] = 'index';
        $datat['data'][0]['children'][0]['name'] = 'Icons';
        $datat['data'][0]['children'][0]['component'] = "icont";
        $datat['data'][0]['children'][0]['meta']['title'] = 'Icons';
        $datat['data'][0]['children'][0]['meta']['icon'] = 'icon';
        $datat['data'][0]['children'][0]['meta']['noCache'] = true;
        return $datat;
    }

}
