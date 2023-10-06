<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Models\ThumbnailGeneratable;
use App\Traits\Models\SlugCountable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SlugCountable, ThumbnailGeneratable;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'on_index_page',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    protected function thumbnailDirectory(): string
    {
        return 'brands';
    }
}
