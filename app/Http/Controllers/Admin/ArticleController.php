<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * 文章列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {


        $categories = Category::select(['id', 'name'])->get();

        $params = [
            '_t' => $request->input('_t', 'title'),
            '_kw' => $request->input('_kw', ''),
        ];
        $lists = Article::select()
            ->when($params['_kw'], function ($query) use ($params) {
                return $query->where($params['_t'], 'like', '%' . $params['_kw'] . '%');
            })
            ->orderByDesc('id')
            ->paginate(10);
        return view('admin.article.index', compact('lists', 'categories', 'params'));
    }

    /**
     * 添加文章
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());
        if ($request->hasFile('thumbnail_upload')) {
            $uploadFiles = $request->file('thumbnail_upload');
            $storePath = 'article_images';
            $paths = [];

            foreach ($uploadFiles as $uploadItem) {
                if ($uploadItem->isValid()) {
                    $filename = $uploadItem->store($storePath);
                    array_push($paths, $filename);
                }
            }

            $article->thumbnail = $paths;
        }
        if ($article->save()) {
            return self::success('添加成功');
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

        if ($request->hasFile('thumbnail_upload')) {
            $uploadFiles = $request->file('thumbnail_upload');
            $storePath = 'article_images';
            $paths = [];

            foreach ($uploadFiles as $uploadItem) {
                if ($uploadItem->isValid()) {
                    $filename = $uploadItem->store($storePath);
                    array_push($paths, $filename);
                }
            }

            //删除旧图片
            if ($article->thumbnail) {
                foreach ($article->thumbnail as $delItem) {
                    \Storage::exists($delItem) && \Storage::delete($delItem);
                }
            }

            $article->thumbnail = $paths;
        }

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
