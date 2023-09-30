<?php

use App\Models\Wishlist;

if (function_exists('hasLikeProductBySession') == false)
{
    function hasLikeProductBySession(int $productId): bool
    {
        $product = Wishlist::where([
            'product_id' => $productId,
            'session_id' => session()->getId()
        ])->first();

        return is_null($product) ? false : true;
    }
}
