<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Models\ThumbnailGeneratable;
use App\Traits\Models\SlugCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, SlugCountable, ThumbnailGeneratable;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id');
    }

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class, 'option_categories', 'category_id', 'option_id');
    }

    protected function thumbnailDirectory(): string
    {
        return 'categories';
    }
}
