<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\HasThumbnail;
use App\Models\Traits\SlugCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory, SlugCountable, HasThumbnail;

    private const COUNT_SHOW_INDEX = 10;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'on_index_page',
        'sorting',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id');
    }

    protected function thumbnailDirectory(): string
    {
        return 'categories';
    }

    public function scopeIndexPage(Builder $query): void
    {
        $query->where('on_index_page', true)
            ->orderBy('sorting')
            ->limit(self::COUNT_SHOW_INDEX);
    }
}
