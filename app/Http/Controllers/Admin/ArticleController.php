<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * 文章列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            '_t' => $request->input('_t', 'title'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Article::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->with(['category'])
            ->orderByDesc('id')
            ->paginate(10);
        $data = $lists->getCollection();
        foreach ($data as $k => &$v) {
            $v['category_name'] = $v['category']['name'];
            unset($v['category']);
        }
        $lists->setCollection(collect($data));
        return self::success('查询成功', $lists);
    }

    /**
     * 分类列表
     */
    public function categoryList()
    {
        $categories = Category::select(['id', 'name'])->get();
        return self::success('查询成功', $categories);
    }


    /**
     * 添加文章
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());
        if ($article->save()) {
            $data_t['id'] = $article['id'];
            $data_t['created_at'] = $article['created_at'];
            $cat_name = DB::table('categories')->where('id', $article['category_id'])->value('name');
            $data_t['cat_name'] = $cat_name;
            return self::success('添加成功', $data_t);
        }
        return self::error('操作失败，请稍后重试！');
    }

    /**
     * 编辑文章
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function edit($id)
    {
        $categories = Category::select(['id', 'name'])->get();
        $article = Article::findOrFail($id);
        return view('admin.article.edit', compact('article', 'categories'))->render();
    }

    /**
     * 更新文章
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleRequest $request)
    {
        $article = Article::findOrFail($request->id);
        $article->fill($request->all());
        if ($article->save()) {
            return self::success('更新成功');
        }
        return self::error('操作失败，请稍后重试！');
    }

    /**
     * 删除文章
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->delete()) {
            return self::success('删除成功');
        }
        return self::error('删除失败');
    }
}
