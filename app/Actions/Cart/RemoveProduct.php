<?php

declare(strict_types=1);

namespace App\Actions\Cart;

class RemoveProduct
{
    public function handle(int $productId): void
    {
        $cart = getCurrentCart($productId);
        $cart->delete();
    }
}
