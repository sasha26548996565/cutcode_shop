<?php

declare(strict_types=1);

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Models\Traits\Filterable;
use App\Models\Traits\SlugCountable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ThumbnailGeneratable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SlugCountable, ThumbnailGeneratable, Filterable, Searchable;

    private const COUNT_SHOW_INDEX = 6;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'thumbnail',
        'text',
        'brand_id',
        'on_index_page',
        'sorting',
    ];

    protected function thumbnailDirectory(): string
    {
        return 'products';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }

    public function scopeIndexPage(Builder $query): void
    {
        $query->where('on_index_page', true)
            ->orderBy('sorting')
            ->limit(self::COUNT_SHOW_INDEX);
    }

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100
        );
    }

    #[SearchUsingPrefix(['title'])]
    #[SearchUsingFullText(['text'])]
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
        ];
    }
}
