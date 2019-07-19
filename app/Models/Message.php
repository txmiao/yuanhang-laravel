<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    const TYPE_USER = 100;
    const TYPE_SYSTEM = 101;
    const UNREAD = 100;
    const READ = 101;

    protected $table = 'messages';

    protected $guarded = ['_token', 'send_type'];

    /**
     * 获取消息类型
     * @param $type
     * @return mixed
     */
    public function getType($type)
    {
        $arr = [
            self::TYPE_USER => '<label class="label label-default">业务消息</label>',
            self::TYPE_SYSTEM => '<label class="label label-info">系统消息</label>'
        ];

        return array_key_exists($type, $arr) ? $arr[$type] : $arr[self::TYPE_SYSTEM];
    }

    public function user()
    {
        return $this->belongsTo('App\\Models\\User');
    }
}
