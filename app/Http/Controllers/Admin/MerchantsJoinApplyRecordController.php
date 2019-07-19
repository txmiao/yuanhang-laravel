<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MerchantsJoinApplyRecordRequest;
use App\Models\FlagshipStoreRecord;
use App\Models\MerchantsJoinApplyRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MerchantsJoinApplyRecordController extends Controller
{
    /**
     * 加盟申请列表
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
        $lists = MerchantsJoinApplyRecord::select()
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
        return view('admin.merchants_join_apply_records.index', compact('lists', 'params'));
    }

    /**
     * 编辑加盟申请记录
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = MerchantsJoinApplyRecord::findOrFail($id);
        return view('admin.merchants_join_apply_records.edit', compact('info'))->render();
    }

    /**
     * 更新加盟申请记录
     * @param MerchantsJoinApplyRecordRequest $request
     * @param FlagshipStoreRecord $flagshipStoreRecord
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MerchantsJoinApplyRecordRequest $request, FlagshipStoreRecord $flagshipStoreRecord)
    {
        try {
            \DB::beginTransaction();
            $joinRecord = MerchantsJoinApplyRecord::findOrFail($request->input('id'));

            if (
                MerchantsJoinApplyRecord::STATUS_WAIT_AUDIT == $joinRecord->status
                && MerchantsJoinApplyRecord::STATUS_PASS == $request->input('status')
            ) {
                //审核通过，更新区域代理记录
                $flagshipStoreRecord->update_record($joinRecord, FlagshipStoreRecord::STATUS_MERCHANTED);

                $joinRecord->fill($this->trim_null_item($request));
                $joinRecord->save();
            }

            \DB::commit();
            return self::success();

        } catch (\Exception $e) {

            \DB::rollBack();
            return self::error($e->getMessage() ?? '');
        }
    }

    public function destroy($id)
    {
        return self::error('暂未开通此功能');
    }
}
