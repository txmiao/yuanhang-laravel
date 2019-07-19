<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends Authenticatable implements JWTSubject
{
    use EntrustUserTrait;
    use Notifiable;

    protected $table = 'admins';

    protected $guarded = [
        '_token', 'role_id'
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 获取当前用户的所有角色
     * @param $admin
     * @return string
     */
    public function getAllRoles($admin)
    {
        $allRoles = json_decode($admin->roles);
        $roles = '';
        foreach ($allRoles as $v) {
            $roles .= $v->display_name . ',';
        }
        return rtrim($roles, ',');
    }

    public function login_log()
    {
        return $this->hasMany(LoginLog::class, 'user_id');
    }
}
