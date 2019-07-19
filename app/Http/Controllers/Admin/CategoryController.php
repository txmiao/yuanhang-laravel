<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * 分类列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'name'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Category::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.category.index', compact('lists', 'params'));
    }

    /**
     * 添加分类
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
        if ($category->save()) {
            return self::success('添加成功');
        }

        return self::error('操作失败，请稍后重试！');
    }

    /**
     * 编辑分类
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'))->render();
    }

    /**
     * 更新分类
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request)
    {
        $category = Category::findOrFail($request->id);
        $category->fill($request->all());
        if ($category->save()) {
            return self::success('更新成功');
        }

        return self::error('操作失败，请稍后重试！');
    }

    /**
     * 删除分类
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (count($category->article)) {
            return self::error('当前分类下存在文章，不能删除');
        }

        if ($category->delete()) {
            return self::success('删除成功');
        }

        return self::error('删除失败');
    }
}
