<?php

namespace App\Http\Requests\Admin;

use App\Models\PlatformPurchaseOrder;
use Illuminate\Foundation\Http\FormRequest;

class PlatformPurchaseOrderRequest extends FormRequest
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
            'express_company' => 'required_if:shipping_status,' . PlatformPurchaseOrder::SHIPPING_STATUS_SHIPPED,
            'express_number' => 'required_if:shipping_status,' . PlatformPurchaseOrder::SHIPPING_STATUS_SHIPPED,
        ];
    }

    public function messages()
    {
        return [
            'express_company.required_if' => '已发货状态时，必须填写快递公司名称',
            'express_number.required_if' => '已发货状态时，必须填写快递单号',
        ];
    }
}
