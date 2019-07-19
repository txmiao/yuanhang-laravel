<?php

namespace App\Http\Controllers\Admin;

use App\Models\FlagshipStoreRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlagshipStoreRecordController extends Controller
{
    /**
     * 区域招商记录列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            'status' => $request->input('status', ''),
            'parent_code' => $request->input('parent_code', 86),
            '_t' => $request->input('_t', 'location_name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = FlagshipStoreRecord::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->when($params['status'], function ($query) use ($params) {
                return $query->where('status', $params['status']);
            })
            ->where('parent_code', $params['parent_code'])
            ->orderBy('location_code')
            ->paginate(10);
        return view('admin.flagship_store_records.index', compact('lists', 'params'));
    }
}
