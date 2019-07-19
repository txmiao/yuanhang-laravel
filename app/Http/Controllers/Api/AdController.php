<?php

namespace App\Http\Controllers\Api;

use App\Models\Ad;
use App\Models\FloatAd;
use App\Transformers\AdTransformer;
use App\Transformers\FloatAdTransformer;
use Dingo\Api\Http\Request;

class AdController extends Controller
{
    /**
     * 广告列表
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->get('type', null);
        $ad = Ad::where('status', Ad::STATUS_OPEN)
            ->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->inRandomOrder()
            ->limit(5)
            ->orderBy('sort', 'id')
            ->get();
        return $this->response->collection($ad, new AdTransformer());
    }

    /**
     * 浮动广告列表
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function floatAd(Request $request)
    {
        $floatAd = FloatAd::where([
            ['status', FloatAd::STATUS_ACTIVE],
            ['city', $request->city]
        ])
            ->inRandomOrder()
            ->first();
        return $this->response->item($floatAd, new FloatAdTransformer());
    }
}


