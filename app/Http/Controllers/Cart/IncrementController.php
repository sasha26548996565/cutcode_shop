<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\Cart\IncrementQuantity;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Cart\IncrementRequest;

class IncrementController extends Controller
{
    private IncrementQuantity $incrementQuantity;

    public function __construct(IncrementQuantity $incrementQuantity)
    {
        $this->incrementQuantity = $incrementQuantity;
    }

    public function __invoke(IncrementRequest $request, Product $product): RedirectResponse
    {
        $quantity = (int) $request->validated()['quantity'];
        $this->incrementQuantity->handle($product->id, $quantity);

        return to_route('cart.index');
    }
}
