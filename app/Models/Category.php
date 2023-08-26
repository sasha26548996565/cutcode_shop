<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\ThumbnailGeneratable;
use App\Models\Traits\SlugCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
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

    protected function thumbnailDirectory(): string
    {
        return 'categories';
    }
}
