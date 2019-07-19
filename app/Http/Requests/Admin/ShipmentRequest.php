<?php

namespace App\Http\Requests\Admin;

use App\Models\Shipment;
use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
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
        return [
            'express_company_select' => 'required_if:status,' . Shipment::STATUS_SHIPPED,
            'express_number' => 'required_if:status,' . Shipment::STATUS_SHIPPED,
        ];
    }

    public function messages()
    {
        return [
            'express_company_select.required_if' => '已发货状态时，必须选择快递公司',
            'express_number.required_if' => '已发货状态时，必须填写快递单号',
        ];
    }
}
