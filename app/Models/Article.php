<?php

namespace App\Models;

use App\Models\Traits\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    use HasTags;
    protected $guarded = ['id'];


    protected static function booted()
    {
        static::creating(function ($article) {
            $slug = Str::slug($article->title);
            $count = Article::where('slug', 'like', "{$slug}%")->count();

            $article->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
