<?php

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalQuantity') == false)
{
    function getTotalQuantity(): int
    {
        return Wishlist::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->count();
    }
}
