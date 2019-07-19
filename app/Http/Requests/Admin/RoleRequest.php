<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class RoleRequest extends FormRequest
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
            $rules['name'] = 'required|max:20';
            $rules['display_name'] = 'required|max:20';
        } else {
            $rules['name'] = 'required|max:20|unique:roles,name';
            $rules['display_name'] = 'required|max:20|unique:roles,display_name';
        }
        $rules['description'] = 'required|max:20';
        $rules['perm_id'] = 'required|array';
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '请填写角色',
            'name.max' => '角色最多20个字符',
            'name.unique' => '该角色已存在',
            'display_name.required' => '请填写名称',
            'display_name.max' => '名称最多20个字符',
            'display_name.unique' => '该名称已存在',
            'description.required' => '请填写角色描述',
            'description.max' => '角色描述最多20个字符',
            'perm_id.required' => '请选择权限',
            'perm_id.array' => '权限数据格式有误',
        ];
    }
}
