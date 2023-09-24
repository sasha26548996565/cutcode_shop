<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cart;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $cart = Cart::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->with(['product', 'product.optionValues.option'])
            ->get();

        $totalPrice = $cart->sum('price');

        return view('cart.index', compact(
            'cart',
            'totalPrice'
        ));
    }
}
