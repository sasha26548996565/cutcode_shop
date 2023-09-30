<?php

declare(strict_types=1);

namespace App\Actions\Wishlist;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ToggleProduct
{
    public function handle(int $productId): void
    {
        if (Auth::user())
        {
            Auth::user()->wishlist()->toggle($productId);
        } else
        {
            $product = Wishlist::where([
                'session_id' => session()->getId(),
                'product_id' => $productId
            ])->first();

            if ($product)
            {
                $product->delete();
            } else
            {
                Wishlist::create([
                    'session_id' => session()->getId(),
                    'product_id' => $productId
                ]);
            }
        }
    }
}
