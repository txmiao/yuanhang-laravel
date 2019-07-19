<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TemplateGoodsRequest extends FormRequest
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
        if ($this->get('id')) {
            $rules = [
                'name' => 'required|unique:template_goods,name,' . $this->get('id')
            ];
        } else {
            $rules = [
                'name' => 'required|unique:template_goods,name',
                'detail_ext' => 'required',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '商品名称不能为空',
            'name.unique' => '商品名称已存在',
            'detail_ext.required' => '商品图文详情不能为空',
        ];
    }
}
