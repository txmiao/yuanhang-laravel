<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabelController extends Controller
{
    /**
     * 标签列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Label::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.label.index', compact('lists', 'params'));
    }

    /**
     * 添加标签
     * @param LabelRequest $labelRequest
     * @param Label $label
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LabelRequest $labelRequest, Label $label)
    {
        $label->fill($labelRequest->all());
        if ($label->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 编辑标签
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $info = Label::findOrFail($id);
        return view('admin.label.edit', compact('info'))->render();
    }

    /**
     * 更新标签
     * @param LabelRequest $labelRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(LabelRequest $labelRequest)
    {
        $label = Label::findOrFail($labelRequest->input('id'));
        $label->fill($labelRequest->all());
        if ($label->save()) {
            return self::success();
        }
        return self::error();
    }

    /**
     * 删除标签
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Label::destroy($id)) {
            return self::success();
        }
        return self::error();
    }
}
