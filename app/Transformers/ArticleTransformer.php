<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'thumbnail' => $this->format_images($article->thumbnail),
            'content' => $article->content,
            'created_at' => $article->created_at->toDateTimeString(),
            'updated_at' => $article->updated_at->toDateTimeString(),
        ];
    }

    private function format_images(array $images)
    {
        $formatImages = [];
        if ($images) {
            $formatImages = array_map(function ($v) {
                return config('app.url') . '/storage/' . $v;
            }, $images);
        }
        return $formatImages;
    }
}
