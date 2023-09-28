<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalQuantity') == false)
{
    function getTotalQuantity(): int
    {
        return Cart::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->sum('quantity');
    }
}
