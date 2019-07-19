<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class System extends Model
{
    protected $table = 'system_config';
    protected $guarded = ['_token'];
    public $timestamps = false;

    /**
     * 获取系统设置
     * @param null $key
     * @param string $default
     * @return string
     */
    public static function getConf($key = null, $default = '')
    {
        $config = Cache::rememberForever('system_config', function () {
            return System::pluck('value', 'code');
        });
        return array_key_exists($key, $config->toArray()) ? $config[$key] : $default;

    }

    /**
     * 动态更新系统设置
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $system = self::where('code', $key)->first();
        if ($system) {
            $system->code = $key;
            $system->value = $value;
            $system->save();
            Cache::forever('system_config', System::pluck('value', 'code'));
        }
    }
}
