<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationRecord extends Model
{
    protected $table = 'invitation_records';
    protected $guarded = ['_token'];
}
