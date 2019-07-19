<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'name' => 'required|exists:admins,name',
//            'password' => 'required',
//            'geetest_challenge' => 'geetest'
//            'captcha_key' => 'required',
//            'verification_code' => 'required'
        ];
    }

    public function messages()
    {
        return [
//            'name.required' => '用户名不能为空',
//            'name.exists' => '用户名不存在',
//            'password.required' => '密码不能为空',
//            'geetest' => config('geetest.server_fail_alert')
//            'captcha_key.required' => '验证码key不能为空',
//            'verification_code.required' => '验证码不能为空'
        ];
    }
}
