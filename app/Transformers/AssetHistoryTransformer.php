<?php

namespace App\Transformers;

use App\Models\AssetHistory;
use League\Fractal\TransformerAbstract;

class AssetHistoryTransformer extends TransformerAbstract
{
    public function transform(AssetHistory $assetHistory)
    {
        return [
            'id' => $assetHistory->id,
//            'origin_event' => $assetHistory->origin_event,
            'number' => $assetHistory->number,
            'created_at' => $assetHistory->created_at,
//            'type' => $assetHistory->type,
            'type_name' => $assetHistory->type_name,
            'origin_event_name' => $assetHistory->origin_event_name,
            'created_at' => $assetHistory->created_at->toDateTimeString(),
        ];
    }
}
