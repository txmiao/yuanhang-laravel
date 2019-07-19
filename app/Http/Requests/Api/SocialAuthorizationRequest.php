<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class SocialAuthorizationRequest extends FormRequest
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
        switch ($this->social_type) {
            case 'weixin':
                $rules = [
                    'code' => 'required_without:access_token|string',
                    'access_token' => 'required_without:code|string',
                ];
                if ($this->social_type == 'weixin' && !$this->code) {
                    $rules['openid'] = 'required|string';
                }
                break;

            case 'qq':
                if ($this->social_type == 'qq') {
                    $rules['access_token'] = 'required|string';
                }
                break;
        }

        return $rules;
    }
}
