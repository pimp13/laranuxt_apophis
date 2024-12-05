<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'slug'
    ];
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
