<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use App\DTO\CartDTO;
use App\Models\Product;
use App\Actions\Cart\AddProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddRequest;
use Illuminate\Http\RedirectResponse;

class AddController extends Controller
{
    private AddProduct $addProduct;

    public function __construct(AddProduct $addProduct)
    {
        $this->addProduct = $addProduct;
    }

    public function __invoke(Product $product, AddRequest $request): RedirectResponse
    {
        $params = new CartDTO($request->validated());
        $cart = $this->addProduct->handle($product, $params);

        if ($cart == false)
        {
            return to_route('product.show', $product);
        }

        return to_route('cart.index');
    }
}
