<?php

use App\Models\Cart;

if (function_exists('getTotalPrice') == false)
{
    function getTotalPrice(): float
    {
        return Cart::where('session_id', session()->getId())->sum('price') / 100;
    }
}
