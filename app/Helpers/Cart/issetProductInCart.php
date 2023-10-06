<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('issetProductInCart') == false)
{
    function issetProductInCart(int $productId): bool
    {
        $cart = Cart::where('product_id', $productId)
            ->where(function ($query) {
                $query->where('session_id', session()->getId())
                    ->orWhere('user_id', optional(Auth::user())->id);
            })->get();

        return $cart->isNotEmpty();
    }
}
