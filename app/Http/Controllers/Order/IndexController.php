<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $orders = Order::with('products')
            ->where('email', Auth::user()->email)
            ->get();

        return view('order.index', compact('orders'));
    }
}
