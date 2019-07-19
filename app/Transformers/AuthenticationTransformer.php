<?php

namespace App\Transformers;

use App\Models\Authentication;
use League\Fractal\TransformerAbstract;

class AuthenticationTransformer extends TransformerAbstract
{
    public function transform(Authentication $authentication)
    {
        return [
            'id' => $authentication->id,
            'user_id' => $authentication->user_id,
            //'auth_type' => $authentication->auth_type,
            'real_name' => $authentication->real_name,
            'id_card_number' => $authentication->id_card_number,
            'auth_images' => $authentication->auth_images,
            'status' => $authentication->status,
            //'status' => $authentication->status === 100 ? '待审核' : '已通过',
            'open_bank' => $authentication->open_bank,
            'account_number' => $authentication->account_number,
            'created_at' => $authentication->created_at->toDateTimeString(),
            'updated_at' => $authentication->updated_at->toDateTimeString(),
        ];
    }
}
