<?php

namespace App\Transformers;

use App\Models\CouponsRecords;
use League\Fractal\TransformerAbstract;

class CouponsRecordsTransformer extends TransformerAbstract
{
    public function transform(CouponsRecords $couponsRecords)
    {
        return [
            'id' => $couponsRecords->id,
//            'origin_event' => $assetHistory->origin_event,
            'number' => $couponsRecords->number,
            'created_at' => $couponsRecords->created_at,
//            'type' => $assetHistory->type,
            'type_name' => $couponsRecords->type_name,
            'origin_event_name' => $couponsRecords->origin_event_name,
            'created_at' => $couponsRecords->created_at->toDateTimeString(),
        ];
    }
}
