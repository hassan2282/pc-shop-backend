<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    protected static function booted()
    {
        static::creating(function ($tag) {
            $slug = Str::slug($tag->name);
            $count = Tag::where('slug', 'like', "{$slug}%")->count();

            $tag->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
