<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->get('id');
        if (!$userId) {
            $rules = [
                'password' => 'required|min:6',
                'real_name' => 'required|string|max:20|unique:users,real_name',
                'phone' => ['required', 'regex:/^1[3456789]\d{9}$/', 'unique:users'],
            ];
        } else {
            $rules = [
//                'name' => 'required|string|max:20|unique:users,name,' . $userId,
                'phone' => ['required', 'regex:/^1[3456789]\d{9}$/', 'unique:users,phone,' . $userId],
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名已存在',
            'phone.required' => '手机号不能为空',
            'phone.unique' => '手机号已存在',
            'password.min' => '密码至少6个字符',
        ];
    }
}
