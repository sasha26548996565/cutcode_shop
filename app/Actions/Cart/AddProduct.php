<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\DTO\CartDTO;
use App\Models\Cart;
use App\Models\Product;

class AddProduct
{
    public function handle(Product $product, CartDTO $params): bool|Cart
    {
        if ($params->quantity > $product->count)
        {
            return false;
        }

        $totalPrice = ($product->price * 100) * $params->quantity;
        $cart = Cart::where([
            'session_id' => session()->getId(),
            'product_id' => $product->id
        ])->first();

        if ($cart)
        {
            $cart->update([
                'price' => $totalPrice,
                ...$params->toArray()
            ]);
            return $cart;
        }

        $cart = Cart::create([
            'session_id' => session()->getId(),
            'product_id' => $product->id,
            'price' => $totalPrice,
            ...$params->toArray()
        ]);

        return $cart;
    }
}
