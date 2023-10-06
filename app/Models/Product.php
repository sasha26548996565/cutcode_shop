<?php

declare(strict_types=1);

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Traits\Models\Filterable;
use App\Traits\Models\SlugCountable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\ThumbnailGeneratable;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SlugCountable, ThumbnailGeneratable, Filterable, Searchable;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'count',
        'thumbnail',
        'text',
        'brand_id',
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

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100
        );
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'product_properties', 'product_id', 'property_id')
            ->withPivot('value');
    }

    public function optionValues(): BelongsToMany
    {
        return $this->belongsToMany(OptionValue::class, 'option_value_products', 'product_id', 'option_value_id');
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
