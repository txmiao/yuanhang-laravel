<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * 订单列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Order::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.order.index', compact('lists', 'params'));
    }

    public function store()
    {
    }

    /**
     * 编辑订单
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = Order::findOrFail($id);
        return view('admin.order.edit', compact('info'))->render();
    }

    /**
     * 更新订单
     * @param Request $request
     * @param Shipment $shipment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Shipment $shipment)
    {
        try {
            $order = Order::findOrFail($request->input('id'));
            $shipment->insert_data($order);
            return self::success();
        } catch (\Exception $e) {
            return self::error($e->getMessage() ?? '');
        }
    }

    public function destroy()
    {
    }
}
