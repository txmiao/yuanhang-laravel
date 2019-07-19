<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ShipmentRequest;
use App\Models\Order;
use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShipmentController extends Controller
{
    /**
     * 发货单列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'order_number'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Shipment::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.shipments.index', compact('lists', 'params'));
    }

    /**
     * 编辑发货单
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = Shipment::findOrFail($id);
        return view('admin.shipments.edit', compact('info'))->render();
    }

    /**
     * 更新发货单
     * @param ShipmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ShipmentRequest $request)
    {
        try {
            \DB::beginTransaction();
            if (Shipment::STATUS_SHIPPED == $request->input('status')) {
                $index = (int)$request->input('express_company_select');
                foreach ($request->all() as $k => $item) {
                    is_null($item) && array_push($except, $k);
                }
                $shipment = Shipment::findOrFail($request->input('id'));
                if (Order::STATUS_WAIT_PAY == $shipment->order->status) {
                    throw new \Exception('未支付订单不能发货');
                }
                $shipment->load('order');
                $shipment->fill(array_merge($request->only('express_number'), [
                    'status' => Shipment::STATUS_SHIPPED,
                    'admin_id' => \Auth::guard('admin')->user()->id,
                    'express_company' => Shipment::$express[$index]['express_company'],
                    'express_official_tel' => Shipment::$express[$index]['express_official_tel']
                ]));
                $shipment->save();

                //更新订单状态
                $shipment->order->update([
                    'status' => Order::STATUS_WAIT_RECEIVE,
                    'shipping_at' => Carbon::now()
                ]);
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
        return self::error('暂未开放此功能');
    }
}
