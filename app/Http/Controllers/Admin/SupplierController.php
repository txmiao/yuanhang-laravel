<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * 供货商列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Supplier::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', $params['_kw'] . '%');
            })
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.supplier.index', compact('lists', 'params'));
    }

    /**
     * 添加供货商
     * @param SupplierRequest $supplierRequest
     * @param Supplier $supplier
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SupplierRequest $supplierRequest, Supplier $supplier)
    {
        $supplier->fill($supplierRequest->all());
        if ($supplier->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑供货商
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('info'))->render();
    }

    /**
     * 更新供货商
     * @param SupplierRequest $supplierRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SupplierRequest $supplierRequest)
    {
        $supplier = Supplier::findOrFail($supplierRequest->input('id'));
        $supplier->fill($supplierRequest->all());
        if ($supplier->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 删除供货商
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        if (count($supplier->template_goods)) {
            return self::error('当前供货商存在模板商品，不能被删除');
        }
        if ($supplier->delete()) {
            return self::success();
        }
        return self::error();
    }
}
