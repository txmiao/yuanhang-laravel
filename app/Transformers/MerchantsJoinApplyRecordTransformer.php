<?php

namespace App\Transformers;

use App\Models\FlagshipStoreRecord;
use League\Fractal\TransformerAbstract;

class MerchantsJoinApplyRecordTransformer extends TransformerAbstract
{
//    protected $availableIncludes = ['store'];

    public function transform(FlagshipStoreRecord $record)
    {
        return [
            'id' => $record->id,
            'level' => $record->level,
            'level_tips' => strip_tags(FlagshipStoreRecord::$levelText[$record->level]),
            'location_code' => $record->location_code,
            'location_name' => $record->location_name,
            'participation_fee' => $record->participation_fee,
            'status' => $record->status,
            'status_tips' => strip_tags(FlagshipStoreRecord::$statusText[$record->status]),
        ];
    }

    /*public function includeStore(FlagshipStoreRecord $record)
    {
        return $this->item($record->store, new SpecialStoreTransformer());
    }*/
}