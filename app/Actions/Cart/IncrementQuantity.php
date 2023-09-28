<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Product;

class IncrementQuantity
{
    public function handle(int $productId, int $quantity): void
    {
        $product = Product::findOrFail($productId);
        $cart = getCurrentCart($productId);
        $incrementQuantity = $quantity + 1;

        if ($incrementQuantity >= ($product->count - $cart->quantity))
        {
            $cart->update(['quantity' => $product->count]);
        } else
        {
            $cart->update(['quantity' => $incrementQuantity]);
        }
    }
}
