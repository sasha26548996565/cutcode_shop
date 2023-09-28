<?php

declare(strict_types=1);

namespace App\Actions\Cart;

class DecrementQuantity
{
    public function handle(int $productId, int $quantity): void
    {
        $cart = getCurrentCart($productId);
        $decrementQuantity = $quantity - 1;

        if ($decrementQuantity <= 0)
        {
            $cart->update(['quantity' => 1]);
        } else
        {
            $cart->update(['quantity' => $decrementQuantity]);
        }
    }
}
