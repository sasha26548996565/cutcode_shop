<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalPrice') == false)
{
    function getTotalPrice(): float
    {
        return Cart::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->sum('price') / 100;
    }
}
