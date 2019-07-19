<?php

namespace App\Transformers;

use App\Models\Address;
use League\Fractal\TransformerAbstract;

class AddressTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(Address $address)
    {
        return [
            'id' => $address->id,
            'user_id' => $address->user_id,
            'consignee' => $address->consignee,
            'phone' => $address->phone,
            'province' => $address->province,
            'city' => $address->city,
            'district' => $address->district,
            'detailed_address' => $address->detailed_address,
            'full_address' => $address->full_address,
            'remark' => $address->remark,
            'is_default' => Address::IS_DEFAULT === $address->is_default ? true : false,
            'created_at' => $address->created_at->toDateTimeString(),
            'updated_at' => $address->updated_at->toDateTimeString(),
        ];
    }

    public function includeUser(Address $address)
    {
        return $this->item($address->user, new UserTransformer());
    }

}
