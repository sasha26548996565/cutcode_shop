<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getCurrentCountProductInCart') == false)
{
    function getCurrentCountProductInCart(int $productId): int
    {
        $cart = Cart::where('product_id', $productId)
            ->where(function ($query) {
                $query->where('session_id', session()->getId())
                    ->orWhere('user_id', optional(Auth::user())->id);
            })->get();

        if ($cart->isNotEmpty())
        {
            return $cart->sum('quantity');
        }

        return 0;
    }
}
