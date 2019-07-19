<?php

namespace App\Transformers;

use App\Models\Collection;
use App\Models\Company;
use League\Fractal\TransformerAbstract;

class CollectionTransformer extends TransformerAbstract
{
    public function transform(Collection $collection)
    {
        return [
            'id' => $collection->id,
            'user_id' => $collection->user_id,
            'company_id' => $collection->company_id,
//            'company_logo' => config('app.url') . ($collection->company_logo ? '/storage/' . $collection->company_logo : '/images/company_default_logo.png'),
            'company_logo' => config('app.url') . (($collection->company->logo && Company::AUTHENTICATED == $collection->company->is_auth)
                    ? '/storage/' . $collection->company->logo
                    : '/images/company_default_logo.png'),
            'company_name' => $collection->company_name,
            'main_line' => $collection->company ? $collection->company->main_line : '',
            'company_address' => $collection->company_address,
            'created_at' => $collection->created_at->toDateTimeString(),
            'updated_at' => $collection->updated_at->toDateTimeString(),
        ];
    }
}