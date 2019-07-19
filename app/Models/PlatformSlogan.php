<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformSlogan extends Model
{
    protected $table = 'platform_slogans';
    protected $guarded = ['_token', 'icon_upload'];
    public $timestamps = false;
}
