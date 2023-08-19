<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\DTO\FilterDTO;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Http\Filters\ProductFilter;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\FilterRequest;
use Illuminate\Database\Eloquent\Builder;

class IndexController extends Controller
{
    private const PAGINATION_COUNT = 12;

    public function __invoke(FilterRequest $request, ?Category $category): View
    {
        $params = FilterDTO::formRequest($request->validated());
        $filter = app()->make(ProductFilter::class, array_filter(['queryParams' => [
            'priceFrom' => $params->priceFrom,
            'priceTo' => $params->priceTo,
            'brands' => $params->brands,
            'categoryId' => $category?->id,
            'sort' => $params->sort,
        ]]));

        $categories = Category::select(['id', 'title', 'slug', 'thumbnail'])
            ->latest()
            ->get();

        $brands = Brand::select(['id', 'title', 'slug', 'thumbnail'])
            ->latest()
            ->get();

        $products = Product::search($params->search)
            ->query(function (Builder $query) use ($filter) {
                $query->select(['id', 'title', 'slug', 'thumbnail', 'price'])
                    ->filter($filter);
            })
            ->paginate(self::PAGINATION_COUNT);

        return view('catalog.index', compact(
            'categories',
            'brands',
            'products',
            'category',
        ));
    }
}
