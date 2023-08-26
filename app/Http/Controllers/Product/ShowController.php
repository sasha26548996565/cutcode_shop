<?php

declare(strict_types=1);

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ShowController extends Controller
{
    public function __invoke(Product $product): View
    {
        $product->load(['optionValues.option']);
        $alsoProducts = Product::whereIn('id', collect(session()->get('also'))->except($product->id))->get();

        $options = $product->optionValues->mapToGroups(function ($optionValue) {
            return [$optionValue->option->title => $optionValue];
        });

        session()->put('also.' . $product->id, $product->id);

        return view('product.show', compact(
            'product',
            'alsoProducts',
            'options',
        ));
    }
}
