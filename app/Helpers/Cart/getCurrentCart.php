<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getCurrentCart') == false)
{
    function getCurrentCart(int $productId): Cart|false
    {
        $cart = Cart::where('product_id', $productId)
            ->where(function ($query) {
                $query->where('session_id', session()->getId())
                    ->orWhere(function ($subquery) {
                        $subquery->where('user_id', optional(Auth::user())->id);
                    });
            })
            ->first();

        return is_null($cart) ? false : $cart;
    }
}
