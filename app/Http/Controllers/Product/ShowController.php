<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ShowController extends Controller
{
    public function __invoke(Product $product, ?int $optionValueId): View
    {
        $product->load(['optionValues.option']);
        $alsoProducts = Product::whereIn('id', collect(session()->get('also'))->except($product->id))->get();
        session()->put('also.' . $product->id, $product->id);

        $options = $product->optionValues->mapToGroups(function ($optionValue) use ($optionValueId) {
            return [
                $optionValue->option->title => $optionValue,
            ];
        });

        return view('product.show', compact(
            'product',
            'alsoProducts',
            'options',
        ));
    }
}
