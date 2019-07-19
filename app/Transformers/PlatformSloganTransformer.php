<?php

namespace App\Transformers;

use App\Models\Ad;
use App\Models\PlatformSlogan;
use League\Fractal\TransformerAbstract;

class PlatformSloganTransformer extends TransformerAbstract
{
    public function transform(PlatformSlogan $platformSlogan)
    {
        return [
            'id' => $platformSlogan->id,
            'name' => $platformSlogan->name,
            'icon' => config('app.url') . '/storage/' . $platformSlogan->icon,
        ];
    }
}