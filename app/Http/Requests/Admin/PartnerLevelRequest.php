<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartnerLevelRequest extends FormRequest
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
                'level' => 'required|unique:partner_levels,level,' . $this->get('id')
            ];
        } else {
            $rules = [
                'level' => 'required|unique:partner_levels,level'
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'level.required' => '等级名称不能为空',
            'level.unique' => '等级名称已存在'
        ];
    }
}
