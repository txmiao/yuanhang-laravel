<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PlatformPurchaseOrderRequest;
use App\Models\PlatformPurchaseOrder;
use App\Models\PlatformPurchaseRecord;
use App\Models\TemplateGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformPurchaseOrderController extends Controller
{
    /**
     * 平台采购订单列表
     * @param Request $request
     * @param TemplateGoods $templateGoods
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, TemplateGoods $templateGoods)
    {
        $goodsList = $templateGoods->get_goods_list_by_type();
        $params = [
            '_t' => $request->input('_t', 'order_number'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = PlatformPurchaseOrder::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.platform_purchase_order.index', compact('lists', 'goodsList', 'params'));
    }

    /**
     * 添加平台采购订单
     * @param Request $request
     * @param PlatformPurchaseOrder $platformPurchaseOrder
     * @param PlatformPurchaseRecord $platformPurchaseRecord
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, PlatformPurchaseOrder $platformPurchaseOrder, PlatformPurchaseRecord $platformPurchaseRecord)
    {
        try {
            \DB::beginTransaction();

            //生成采购订单记录
            $orderNumber = create_order_number();
            $platformPurchaseOrderInfo = $platformPurchaseRecord->build_data($request->input('goods_id'), $request->input('number'), $orderNumber);
            $platformPurchaseOrder->fill(array_merge($request->all(), [
                'order_amount' => $platformPurchaseOrderInfo['orderAmount'],
                'order_number' => $orderNumber,
                'admin_id' => \Auth::guard('admin')->user()->id,
            ]));
            $platformPurchaseOrder->save();

            //生成采购商品记录
            PlatformPurchaseRecord::insert($platformPurchaseOrderInfo['platformPurchaseRecordData']);
            \DB::commit();

            return self::success();

        } catch (\Exception $e) {
            \DB::rollBack();
            return self::error($e->getMessage());
        }
    }

    /**
     * 编辑平台采购订单
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = PlatformPurchaseOrder::findOrFail($id);
        return view('admin.platform_purchase_order.edit', compact('info'))->render();
    }

    /**
     * 更新平台采购订单
     * @param PlatformPurchaseOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PlatformPurchaseOrderRequest $request)
    {
        $except = [];
        foreach ($request->all() as $k => $item) {
            is_null($item) && array_push($except, $k);
        }
        $platformPurchaseOrder = PlatformPurchaseOrder::findOrFail($request->input('id'));
        $platformPurchaseOrder->fill($request->except($except));
        if ($platformPurchaseOrder->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 删除平台采购订单
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $platformPurchaseOrder = PlatformPurchaseOrder::findOrFail($id);
        if ($platformPurchaseOrder->shipping_status == PlatformPurchaseOrder::SHIPPING_STATUS_SHIPPED) {
            return self::error('该订单已发货，不能被删除');
        }
        if ($platformPurchaseOrder->delete()) {
            return self::success();
        }
        return self::error();
    }
}
