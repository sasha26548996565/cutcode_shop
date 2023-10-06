<?php

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

if (function_exists('getWishlist') == false)
{
    function getWishlist(): Collection|false
    {
        $wishlist = Wishlist::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->with(['product', 'product.optionValues.option'])
            ->get();
        return is_null($wishlist) ? false : $wishlist;
    }
}
