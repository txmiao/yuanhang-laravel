<?php

namespace App\Http\Controllers\Api;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RegionController extends Controller
{
    /**
     * 获取三级联动列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $lists = ($request->has('type') && 'without_child' == $request->type)
            ? (Cache::has('regions') ? Cache::get('regions') : Region::getRegions())
            : (Cache::has('regions_with_child') ? Cache::get('regions_with_child') : Region::getRegionsWithChild());
        return $this->response->array($lists);
    }

    /**
     * 获取地区列表
     * @param Request $request
     * @return mixed
     */
    public function region_lists(Request $request)
    {
        $parentCode = $request->input('p_code', 86);
        $regions = Cache::get('regions', function () use ($parentCode) {
            return Region::getRegions();
        });
        return $regions[$parentCode];
    }
}
