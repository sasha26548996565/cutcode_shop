<?php

declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Models\Brand;
use App\DTO\FilterDTO;
use App\Models\Option;
use App\Models\Product;
use App\Models\Category;
use App\Http\Filters\ProductFilter;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Catalog\FilterRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
            'optionValues' => $params->optionValueIds,
            'categoryId' => $category?->id,
            'sort' => $params->sort,
        ]]));

        $options = $this->getOptions($category->id);
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $products = $this->getProducts($filter, self::PAGINATION_COUNT, $params->search);

        return view('catalog.index', compact(
            'categories',
            'brands',
            'products',
            'category',
            'options',
        ));
    }

    private function getOptions(?int $categoryId): Collection
    {
        return Option::with('optionValues')
            ->when($categoryId, function (Builder $query) use ($categoryId) {
                $query->whereHas('categories', function (Builder $query) use ($categoryId) {
                    $query->where('categories.id', $categoryId);
                });
            })->get();
    }

    private function getCategories(): Collection
    {
        return Category::select(['id', 'title', 'slug', 'thumbnail'])
            ->latest()
            ->get();
    }

    private function getBrands(): Collection
    {
        return Brand::select(['id', 'title', 'slug', 'thumbnail'])
            ->latest()
            ->get();
    }

    private function getProducts(ProductFilter $filter, int $paginationCount, ?string $search): LengthAwarePaginator
    {
        return Product::search($search)
            ->query(function (Builder $query) use ($filter) {
                $query->with('brand', 'optionValues.option')
                    ->select(['id', 'title', 'slug', 'thumbnail', 'price'])
                    ->filter($filter);
            })
            ->paginate($paginationCount);
    }
}
