<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    const UN_SHOW = 100;
    const SHOWED = 101;
    const UN_TOP = 100;
    const IS_TOP = 101;

    protected $table = 'articles';
    protected $guarded = ['_token', 'thumbnail_upload'];
    protected $casts = [
        'thumbnail' => 'array'
    ];

    /**
     * 获取关联的分类信息
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
