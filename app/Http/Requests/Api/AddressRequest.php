<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class AddressRequest extends FormRequest
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
                    'consignee' => 'required|string|max:10',
                    'phone' => 'required|regex:/^1[34578]\d{9}$/',
                    'province' => 'required|string|max:120',
                    'city' => 'required|string|max:120',
                    'district' => 'required|string|max:120',
                    'detailed_address' => 'required|string|max:120',
                    'is_default' => 'numeric|in:100,101',
                    'remark' => 'string|max:255',
                ];
                break;
            case 'PATCH':
                return [
                    'consignee' => 'string|max:10',
                    'phone' => 'regex:/^1[34578]\d{9}$/',
                    'province' => 'string|max:120',
                    'city' => 'string|max:120',
                    'district' => 'string|max:120',
                    'detailed_address' => 'string|max:120',
                    'is_default' => 'numeric|in:100,101',
                    'remark' => 'string|max:255',
                ];
                break;
        }

    }

    public function attributes()
    {
        return [
            'consignee' => '收货人',
            'province' => '省',
            'city' => '市',
            'district' => '区',
            'detailed_address' => '详细地址',
            'remark' => '备注信息',
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => '手机号格式有误'
        ];
    }
}
