<?php

namespace App\Transformers;

use App\Models\Ad;
use League\Fractal\TransformerAbstract;

class AdTransformer extends TransformerAbstract
{
    public function transform(Ad $ad)
    {
        return [
            'id' => $ad->id,
            'name' => $ad->name,
            'image' => $ad->image ? config('app.url') . '/storage/' . $ad->image : null,
            'url' => $ad->url,
            'created_at' => $ad->created_at->toDateTimeString(),
            'updated_at' => $ad->updated_at->toDateTimeString(),
        ];
    }
}