<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Catalog\FilterRequest;

class IndexController extends Controller
{
    private const PAGINATION_COUNT = 12;

    public function __invoke(FilterRequest $request, ?Category $category): View
    {
        $params = $request->validated();
        $filter = app()->make(ProductFilter::class, array_filter(['queryParams' => [
            'priceFrom' => $params['filters']['price']['from'] ?? null,
            'priceTo' => $params['filters']['price']['to'] ?? null,
            'brands' => $params['filters']['brands'] ?? null,
            'categoryId' => $category?->id,
            'sort' => $params['sort'] ?? null,
        ]]));

        $categories = Category::select(['id', 'title', 'slug', 'thumbnail'])
            ->latest()
            ->get();

        $brands = Brand::select(['id', 'title', 'slug', 'thumbnail'])
            ->latest()
            ->get();

        $products = Product::select(['id', 'title', 'slug', 'thumbnail', 'price'])
            ->filter($filter)
            ->paginate(self::PAGINATION_COUNT);

        return view('catalog.index', compact(
            'categories',
            'brands',
            'products',
            'category',
        ));
    }
}
