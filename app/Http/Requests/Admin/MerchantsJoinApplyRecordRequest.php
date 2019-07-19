<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MerchantsJoinApplyRecordRequest extends FormRequest
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
            'refuse_reason' => 'required_if:status,' . \App\Models\MerchantsJoinApplyRecord::STATUS_FAIL
        ];
    }

    public function messages()
    {
        return [
            'refuse_reason.required_if' => '请填写拒绝理由'
        ];
    }
}
