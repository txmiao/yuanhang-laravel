<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                'name' => 'required|unique:suppliers,name,' . $this->get('id')
            ];
        } else {
            $rules = [
                'name' => 'required|unique:suppliers,name'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '供货商名称不能为空',
            'name.unique' => '供货商名称已存在'
        ];
    }
}
