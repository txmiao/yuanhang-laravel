<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoginLog extends Model
{
    protected $table = 'login_logs';
    protected $dates = ['time'];
    public $timestamps = false;


    /**
     * 记录登录日志
     * @param null $log
     */
    protected function log($log = null)
    {
        $logLogin = new self();
        if ($log) {
            $logLogin->ip = $log['ip'];
            $logLogin->location = $log['location'];
            $logLogin->user_id = Auth::guard('admin')->id();
            $logLogin->time = Carbon::now();
            $logLogin->save();
        }
    }

    /**
     * 获取关联的用户信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admin()
    {
        return $this->hasOne('\\App\\Models\\Admin', 'id', 'user_id');
    }
}
