<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalPrice') == false)
{
    function getTotalPrice(): float
    {
        if (Auth::user() == null)
        {
            return Cart::where('session_id', session()->getId())->sum('price') / 100;
        }

        return Cart::where('user_id', Auth::user()->id)->sum('price') / 100;
    }
}
