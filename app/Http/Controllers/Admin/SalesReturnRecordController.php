<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SalesReturnRecordRequest;
use App\Models\SalesReturnRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesReturnRecordController extends Controller
{
    /**
     * 退货申请列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            'status' => $request->input('status', ''),
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = SalesReturnRecord::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->whereHas('user', function ($query) use ($params) {
                    $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
                });
            })
            ->when($params['status'], function ($query) use ($params) {
                return $query->where('status', $params['status']);
            })
            ->orderBy('status')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.sales_return_records.index', compact('lists', 'params'));
    }

    /**
     * 编辑退货申请
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = SalesReturnRecord::findOrFail($id);
        return view('admin.sales_return_records.edit', compact('info'))->render();
    }

    /**
     * 更新退货申请
     * @param SalesReturnRecordRequest $salesReturnRecordRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SalesReturnRecordRequest $salesReturnRecordRequest)
    {
        $salesReturnRecord = SalesReturnRecord::findOrFail($salesReturnRecordRequest->input('id'));
        $salesReturnRecord->fill(array_merge($salesReturnRecordRequest->only('status'),
            ['refuse_reason' => is_null($salesReturnRecordRequest->input('refuse_reason')) ? '-' : $salesReturnRecordRequest->input('refuse_reason')],
            ['admin_id' => \Auth::guard('admin')->user()->id]
        ));
        if ($salesReturnRecord->save()) {
            return self::success();
        }

        return self::error();
    }
}
