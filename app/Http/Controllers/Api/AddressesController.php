<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AddressRequest;
use App\Models\Address;
use App\Transformers\AddressTransformer;


class AddressesController extends Controller
{
    /**
     * 用户地址列表
     *
     */
    public function index()
    {
        try {
            $user = $this->user();
            $data = Address::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
//            dd($data->toArray());
            return $this->response->paginator($data, new AddressTransformer());
        } catch (\Exception $e) {
            return $this->response->errorForbidden('查找用户地址列表失败');
        }
    }

    /**
     * 用户增加地址
     *
     */
    public function store(AddressRequest $request)
    {
        try {
            $user = $this->user();
            $is_default = $request->is_default;
            $Address = new Address();
            if ($is_default == 101) {
                Address::where('user_id', $user->id)->update(['is_default' => 100]);
            }
            $gather_data = $Address->gatherData($user->id, $is_default, $request);
            $data = Address::create($gather_data);
            return $this->response->item($data, new AddressTransformer());
        } catch (\Exception $e) {
            return $this->response->errorForbidden('增加地址失败');
        }
        //return response()->json(['status' => '200', 'msg' => '增加地址成功', 'data' => $data]);
    }

    /**
     * 用户地址编辑
     *
     */
    public function edit($id)
    {
        try {
            $data = Address::find($id);
            return $this->response->item($data, new AddressTransformer());
        } catch (\Exception $e) {
            return $this->response->errorForbidden('查看地址详情失败');
        }
    }

    /**
     * 用户更新地址
     *
     */
    public function update(AddressRequest $request)
    {
        $id = $request->input('id');
        $add = Address::findOrFail($id);
        if (!$add) {
            return $this->response->errorBadRequest();
        }

        $user = $this->user();
        $is_default = $request->is_default;
        $Address = new Address();

        if ($is_default == 101) {
            Address::where('user_id', $user->id)->update(['is_default' => 100]);
        }
        try {
            $data = $Address->gatherData($user->id, $is_default, $request);
            $add = Address:: updateOrCreate(
                ['id' => $id],
                $data
            );
            return $this->response->item($add, new AddressTransformer());
        } catch (\Exception $e) {
            return $this->response->errorForbidden('查看地址详情失败');
        }
    }

    /**
     * 用户地址删除
     *
     */
    public function destroy($id)
    {
        try {
            $data = Address::findOrFail($id);
            $data->delete();
            return $this->response->noContent();
        } catch (\Exception $e) {
            return $this->response->errorForbidden('删除地址失败');
        }
    }
}
