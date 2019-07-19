<?php

namespace App\Http\Controllers\Api;

use App\Models\PlatformSlogan;
use App\Transformers\PlatformSloganTransformer;

class PlatformSloganController extends Controller
{
    /**
     * 平台标语列表
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $lists = PlatformSlogan::orderByDesc('sort')->get();
        return $this->response->collection($lists, new PlatformSloganTransformer());
    }
}
