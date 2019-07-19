<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAdmin extends Model
{
    protected $table = 'store_admins';
    protected $guarded = ['_token'];
}
