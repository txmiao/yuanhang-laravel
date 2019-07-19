<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'send_type' => 'required',
            'type' => 'required',
            'title' => 'required|max:30',
            'content' => 'required',
        ];

        if ('single' == $this->send_type) {
            array_push($rules, [
                'user_id' => 'required|exists:users,id'
            ]);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'send_type.required' => '发送类型不能为空',
            'type.required' => '消息类型不能为空',
            'title.required' => '消息标题不能为空',
            'title.max' => '消息标题最多30个字符',
            'content.required' => '消息内容不能为空',
            'user_id.required_if' => '发送给单一用户时，必须指定正确的UID',
        ];
    }
}
