<?php

namespace App\Http\Requests\Api;

use Illuminate\Support\Facades\Auth;
use Dingo\Api\Http\FormRequest;

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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:20',
                    'password' => 'required|string|min:6',
                    'type' => 'required|in:100,101',
                    'verification_key' => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;
            case 'PATCH':
                $userId = Auth::guard('api')->id();
                return [
//                    'name' => 'between:3,20|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . $userId,
                    'name' => 'between:1,20|unique:users,name,' . $userId,
                    'avatar_image_id' => 'exists:images,id,type,avatar,user_id,' . $userId,
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
            'type' => '用户类型'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => '用户名已被占用，请重新填写',
            'name.regex' => '用户名只支持英文、数字、横杆和下划线。',
            'name.between' => '用户名必须介于 1 - 20 个字符之间。',
            'name.required' => '用户名不能为空。',
        ];
    }
}
