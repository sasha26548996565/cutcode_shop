<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class ShowController extends Controller
{
    public function __invoke(Product $product): View
    {
        $product->load(['optionValues.option', 'brand']);
        $alsoProducts = $this->addViewed($product->id);

        $optionValues = $product->optionValues->mapToGroups(function ($optionValue) {
            return [
                $optionValue->option->title => $optionValue,
            ];
        });

        return view('product.show', compact(
            'product',
            'alsoProducts',
            'optionValues'
        ));
    }

    private function addViewed(int $productId): Collection
    {
        return Product::whereIn('id', collect(session()->get('also'))
            ->except($productId))
            ->get();
        session()->put('also.' . $productId, $productId);
    }
}
