<?php

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

if (function_exists('getTotalPrice') == false)
{
    function getTotalPrice(): float
    {
        $wishlist = Wishlist::with('product')
            ->where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->get();

        $totalPrice = 0;

        foreach ($wishlist as $item)
        {
            $totalPrice += $item->product->price;
        }

        return $totalPrice;
    }
}
