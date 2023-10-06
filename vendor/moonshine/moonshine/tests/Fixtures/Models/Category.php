<?php

namespace MoonShine\Tests\Fixtures\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use MoonShine\Tests\Fixtures\Models\Traits\MorphRelationTrait;
use MoonShine\Tests\Fixtures\Models\Traits\UserHasOneTrait;

class Category extends Model
{
    use UserHasOneTrait;

    use MorphRelationTrait;

    protected $fillable = [
        'name',
        'content',
        'moonshine_user_id',
        'public_at',
        'created_at',
        'updated_at',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'category_id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(CategoryImage::class, 'category_id');
    }
}
