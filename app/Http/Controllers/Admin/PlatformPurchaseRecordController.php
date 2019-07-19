<?php

namespace App\Http\Controllers\Admin;

use App\Models\PartnerGoods;
use App\Models\PlatformPurchaseOrder;
use App\Models\PlatformPurchaseRecord;
use App\Models\PlatformTemplateGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformPurchaseRecordController extends Controller
{
    /**
     * 平台采购商品列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'order_number'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = PlatformPurchaseRecord::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.platform_purchase_records.index', compact('lists', 'params'));
    }

    /**
     * 编辑平台商品记录
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = PlatformPurchaseRecord::findOrFail($id);
        return view('admin.platform_purchase_records.edit', compact('info'))->render();
    }

    /**
     * 更新平台商品记录
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            \DB::beginTransaction();
            $platformPurchaseRecord = PlatformPurchaseRecord::findOrFail($request->input('id'));

            if (
                (PlatformPurchaseOrder::SHIPPING_STATUS_WAIT_SHIPPING == $platformPurchaseRecord->platform_purchase_order->shipping_status)
                && PlatformPurchaseRecord::STATUS_CONFIRMED == $request->input('status')
            ) {
                return self::error('订单未发货，商品不能被入库');
            }

            //如果类型为合伙人商品，更新合伙人商品表库存，其它商品更新平台模板商品库
            if (
                PlatformPurchaseRecord::STATUS_CONFIRMED == $request->input('status')
                && $platformPurchaseRecord->status == PlatformPurchaseRecord::STATUS_UN_CONFIRM
            ) {
                $targetModel = PlatformPurchaseRecord::GOODS_TYPE_PARTNER == $platformPurchaseRecord->type
                    ? (new PartnerGoods())
                    : (new PlatformTemplateGoods());
                $targetModel->insert_data($platformPurchaseRecord);
            }
            $platformPurchaseRecord->fill($request->all());
            $platformPurchaseRecord->admin_id = \Auth::guard('admin')->user()->id;
            $platformPurchaseRecord->save();

            \DB::commit();
            return self::success();

        } catch (\Exception $e) {

            \DB::rollBack();
            return self::error();
        }
    }
}
