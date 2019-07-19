<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $guarded = ['_token', 'image_upload'];

    const STATUS_CLOSE = 100;
    const STATUS_OPEN = 101;

    public static $statusText = [
        self::STATUS_CLOSE => '<span class="label label-danger">已关闭</span>',
        self::STATUS_OPEN => '<span class="label label-success">已开启</span>',
    ];
}
