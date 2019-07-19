<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePurchaseRecord extends Model
{
    protected $table = 'store_purchase_records';
    protected $guarded = ['_token'];

    const STATUS_UN_CONFIRM = 100;
    const STATUS_CONFIRMED = 101;

    public static $statusText = [
        self::STATUS_UN_CONFIRM => '<span class="label label-warning">未确认</span>',
        self::STATUS_CONFIRMED => '<span class="label label-success">已确认</span>',
    ];
}
