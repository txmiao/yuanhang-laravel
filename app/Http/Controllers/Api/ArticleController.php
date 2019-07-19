<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Transformers\ArticleTransformer;

class ArticleController extends Controller
{
    /**
     * 帮助中心
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $list = Article::where('is_show', Article::SHOWED)
            ->orderByDesc('is_top')
            ->orderByDesc('sort')
            ->orderByDesc('created_at')
            ->paginate(10);

        return $this->response->paginator($list, new ArticleTransformer());
    }
}
