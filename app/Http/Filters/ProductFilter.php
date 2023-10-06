<?php

declare(strict_types=1);

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    private const PRICE_FROM = 'priceFrom';
    private const PRICE_TO = 'priceTo';
    private const BRANDS = 'brands';
    private const OPTION_VALUES = 'optionValues';
    private const CATEGORY_ID = 'categoryId';
    private const SORT = 'sort';
    private const ALLOWED_SORTS = ['title', 'price'];
    private const ALLOWED_SORT_DIRECTION = ['asc', 'desc'];

    public function getCallbacks(): array
    {
        return [
            self::PRICE_FROM => [$this, 'priceFrom'],
            self::PRICE_TO => [$this, 'priceTo'],
            self::BRANDS => [$this, 'brands'],
            self::CATEGORY_ID => [$this, 'categoryId'],
            self::SORT => [$this, 'sort'],
            self::OPTION_VALUES => [$this, 'optionValues']
        ];
    }

    public function priceFrom(Builder $query, int $priceFrom): void
    {
        $query->where('price', '>=', $priceFrom * 100);
    }

    public function priceTo(Builder $query, int $priceTo): void
    {
        $query->where('price', '<=', $priceTo * 100);
    }

    public function brands(Builder $query, array $brandIds): void
    {
        $query->whereIn('brand_id', $brandIds);
    }

    public function optionValues(Builder $query, array $optionValueIds): void
    {
        $query->whereHas('optionValues', function (Builder $query) use ($optionValueIds) {
            $query->whereIn('option_values.id', $optionValueIds);
        });
    }

    public function categoryId(Builder $query, int $categoryId): void
    {
        $query->whereRelation('categories', 'categories.id', '=', $categoryId);
    }

    public function sort(Builder $query, string $sort): void
    {
        $sort = explode('|', $sort);
        $query->orderBy(in_array($sort[0], self::ALLOWED_SORTS) ? $sort[0] : 'title',
            in_array($sort[1], self::ALLOWED_SORT_DIRECTION) ? $sort[1] : 'asc');
    }
}
