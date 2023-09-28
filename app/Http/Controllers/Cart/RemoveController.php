<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\Cart\RemoveProduct;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class RemoveController extends Controller
{
    private RemoveProduct $removeProduct;

    public function __construct(RemoveProduct $removeProduct)
    {
        $this->removeProduct = $removeProduct;
    }

    public function __invoke(Product $product): RedirectResponse
    {
        $this->removeProduct->handle($product->id);
        
        return to_route('cart.index');
    }
}
