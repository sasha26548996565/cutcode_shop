<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalQuantity') == false)
{
    function getTotalQuantity(): int
    {
        if (Auth::user() == null)
        {
            return Cart::where('session_id', session()->getId())->sum('quantity');
        }

        return Cart::where('user_id', Auth::user()->id)->sum('quantity');
    }
}
