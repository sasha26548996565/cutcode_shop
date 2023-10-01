<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalPriceInCart') == false)
{
    function getTotalPriceInCart(): float
    {
        $cart = Cart::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->with(['product', 'product.optionValues.option'])
            ->get();
        $totalPrice = $cart->sum('price');
        
        return $totalPrice;
    }
}
