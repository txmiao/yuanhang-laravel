<?php

namespace App\Http\Controllers\Api;

use App\Models\System;

class SystemController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = $config = System::pluck('value', 'code');
    }

    /**
     * 获取平台设置
     * @return mixed
     */
    public function index()
    {
        $platform = [
            'platform_logo' => config('app.url') . '/storage/' . array_get($this->config, 'platform_logo'),
            'app_name' => array_get($this->config, 'app_name'),
            'belong_to_company' => array_get($this->config, 'belong_to_company'),
            'app_version' => array_get($this->config, 'app_version'),
            'service_tel' => array_get($this->config, 'service_tel'),
        ];
        return $this->response->array($platform);
    }

    /**
     * 获取背景和置顶颜色设置
     * @return mixed
     */
    public function config()
    {
        $systemConfig = [
            'top_color' => array_get($this->config, 'top_color'),
            'background_image' => config('app.url') . '/storage/' . array_get($this->config, 'background_image')
        ];
        return $this->response->array($systemConfig);
    }
}
