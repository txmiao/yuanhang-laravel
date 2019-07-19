<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
     * 验证规则
     * @return array
     */
    public function rules()
    {
        if ($this->input('pid')) {
            $rules = [
//                'link' => 'required',
//                'permission' => 'required',
            ];
        } else {
            $rules = [
//                'icon' => 'required',
            ];
        }

        if ($this->input('id')) {
            $rules['name'] = 'required';
        } else {
            $rules['name'] = 'required|unique:menus,name';
        }

        return $rules;
    }

    /**
     * 验证错误消息
     * @return array
     */
    public function messages()
    {
        return [
//            'link.required' => '请填写资源链接',
            'permission.required' => '请填写资源权限',
            'icon.required' => '请填写资源图标',
            'name.required' => '请填写资源名称',
            'name.unique' => '该资源名称已存在',
        ];
    }
}
