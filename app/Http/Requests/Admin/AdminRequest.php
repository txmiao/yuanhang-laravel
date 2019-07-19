<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        if ($this->input('id')) {
            $rules['name'] = 'required|alpha_dash';
            $rules['email'] = 'required';
        } else {
            $rules['name'] = 'required|alpha_dash|unique:admins,name';
            $rules['password'] = 'required|min:6';
            $rules['email'] = 'required|email|unique:admins,email';
        }
        $rules['role_id'] = 'required|array';
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '请填写用户名',
            'name.alpha_num' => '用户名只能包含字母和数字',
            'name.unique' => '该用户名已存在',
            'email.required' => '请填写邮箱',
            'email.email' => '邮箱格式不正确',
            'email.unique' => '该邮箱已存在',
            'password.required' => '请填写密码',
            'password.min' => '密码至少6个字符',
            'role_id.required' => '请选择用户角色',
            'role_id.array' => '用户角色格式有误',
        ];
    }
}
