<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Cart;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $cart = Cart::where('session_id', session()->getId())
            ->with(['product', 'product.optionValues.option'])
            ->get();

        $totalPrice = Cart::where('session_id', session()->getId())
            ->sum('price') / 100;

        return view('cart.index', compact(
            'cart',
            'totalPrice'
        ));
    }
}
