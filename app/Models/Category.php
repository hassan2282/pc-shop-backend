<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    
    protected static function booted()
    {
        static::creating(function ($category) {
            $slug = Str::slug($category->name);
            $count = Category::where('slug', 'like', "{$slug}%")->count();

            $category->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }



    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
