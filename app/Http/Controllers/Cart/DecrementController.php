<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\Actions\Cart\DecrementQuantity;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Cart\DecrementRequest;

class DecrementController extends Controller
{
    private DecrementQuantity $decrementQuantity;

    public function __construct(DecrementQuantity $decrementQuantity)
    {
        $this->decrementQuantity = $decrementQuantity;
    }

    public function __invoke(DecrementRequest $request, Product $product): RedirectResponse
    {
        $quantity = (int) $request->validated()['quantity'];
        $this->decrementQuantity->handle($product->id, $quantity);

        return to_route('cart.index');
    }
}
