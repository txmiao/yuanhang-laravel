<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;
use Illuminate\Contracts\Validation;
use Dingo\Api\Exception\StoreResourceFailedException;

class ImageRequest extends FormRequest
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
            'image' => 'mimes:jpg,jpeg,bmp,png,gif'
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => '图片格式有误，请重新选择'
        ];
    }

    protected function failedValidation(Validation\Validator $validator)
    {
        $message = $validator->errors()->first();
        throw new StoreResourceFailedException($message);
    }
}
