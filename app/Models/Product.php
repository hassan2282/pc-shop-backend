<?php

namespace App\Models;

use App\Models\Traits\HasTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasTags;


    protected static function booted()
    {
        static::creating(function ($product) {
            $slug = Str::slug($product->title);
            $count = Product::where('slug', 'like', "{$slug}%")->count();

            $product->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }


    protected $guarded = ['id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'taggable');
    }

}
