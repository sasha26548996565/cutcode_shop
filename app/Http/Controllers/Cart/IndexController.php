<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $cart = getCart();
        $totalPrice = $cart->sum('price');

        return view('cart.index', compact(
            'cart',
            'totalPrice'
        ));
    }
}
