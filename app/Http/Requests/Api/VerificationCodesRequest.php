<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;
use Illuminate\Contracts\Validation;
use Dingo\Api\Exception\StoreResourceFailedException;

class VerificationCodesRequest extends FormRequest
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
        switch ($this->get('sms_type')) {
            default:
            case 'add_user': //用户注册
                return [
                    'phone' => [
                        'required',
                        'regex:/^1[3456789]\d{9}$/',
                        'unique:users'
                    ]
                ];
                break;
            case 'modify_password': //修改密码
            case 'forget_password': //忘记密码
                return [
                    'phone' => [
                        'required',
                        'regex:/^1[3456789]\d{9}$/',
                        'exists:users,phone,deleted_at,NULL'
                    ]
                ];
                break;
        }

    }

    public function messages()
    {
        return [
            'phone.required' => '手机号不能为空',
            'phone.regex' => '手机号格式有误',
            'phone.unique' => '该手机号已被注册',
            'phone.exists' => '该手机号未注册，请重新输入',
        ];
    }

    protected function failedValidation(Validation\Validator $validator)
    {
        $message = $validator->errors()->first();
        throw new StoreResourceFailedException($message);
    }
}
