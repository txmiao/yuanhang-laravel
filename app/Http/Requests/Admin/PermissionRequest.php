<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        if (request()->input('id')) {
            $rules = [
                'name' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required|unique:permissions,name',
            ];
        }
        return array_merge($rules, [
            'display_name' => 'required|max:20',
            'description' => 'required|max:20'
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => '请填写权限',
            'name.unique' => '该权限已存在',
            'display_name.required' => '请填写权限名称',
            'display_name.max' => '权限名称最多20个字符',
            'description.required' => '请填写权限描述',
            'description.max' => '权限描述最多20个字符',
        ];
    }
}
