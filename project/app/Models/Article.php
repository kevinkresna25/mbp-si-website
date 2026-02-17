<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug',
        'content', 'excerpt', 'featured_image', 'status', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Slug generation is handled by ArticleController with uniqueness check

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class , 'category_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class , 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
