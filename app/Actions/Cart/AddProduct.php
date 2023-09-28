<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\DTO\CartDTO;
use App\Models\Cart;
use App\Models\Product;

class AddProduct
{
    public function handle(Product $product, CartDTO $params): false|Cart
    {
        if ($params->quantity > $product->count)
        {
            return false;
        }

        $cart = getCurrentCart($product->id);

        if ($cart)
        {
            $cart->update([
                ...$params->toArray()
            ]);
            return $cart;
        }

        $cart = Cart::create([
            'session_id' => session()->getId(),
            'product_id' => $product->id,
            ...$params->toArray()
        ]);

        return $cart;
    }
}
