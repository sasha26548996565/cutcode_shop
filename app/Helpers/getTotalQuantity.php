<?php

use App\Models\Cart;

if (function_exists('getTotalQuantity') == false)
{
    function getTotalQuantity(): int
    {
        return Cart::where('session_id', session()->getId())->sum('quantity');
    }
}
