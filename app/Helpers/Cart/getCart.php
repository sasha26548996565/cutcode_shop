<?php

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

if (function_exists('getCart') == false)
{
    function getCart(): Collection|false
    {
        $cart = Cart::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->with(['product', 'product.optionValues.option'])
            ->get();
        return is_null($cart) ? false : $cart;
    }
}
