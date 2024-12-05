<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'summary',
        'body',
        'visits',
        'is_active',
        'published_at',
        'meta_title',
        'meta_description',
        'user_id',
        'article_category_id'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
