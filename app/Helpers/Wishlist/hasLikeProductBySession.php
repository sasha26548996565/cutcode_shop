<?php

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

if (function_exists('hasLikeProductBySession') == false)
{
    function hasLikeProductBySession(int $productId): bool
    {
        $product = Wishlist::where('product_id', $productId)
            ->where(function ($query) {
                $query->where('session_id', session()->getId())
                    ->orWhere(function ($subquery) {
                        $subquery->where('user_id', optional(Auth::user())->id);
                    });
            })
            ->first();

        return is_null($product) ? false : true;
    }
}
