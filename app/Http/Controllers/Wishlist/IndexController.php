<?php

declare(strict_types=1);

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    private const PAGINATION_COUNT = 12;

    public function __invoke(): View
    {
        $wishlist = getWishlist();

        $productIds = collect($wishlist)->map(function ($wishlistItem) {
            return $wishlistItem->product->id;
        });
        $products = Product::whereIn('id', $productIds)->paginate(self::PAGINATION_COUNT);

        return view('wishlist.index', compact('products'));
    }
}
