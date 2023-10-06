<?php

declare(stirct_types=1);

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    public function __invoke(Order $order): View
    {
        $order->products->each(function ($product) {
            $product->load('optionValues.option');
        });
        return view('order.show', compact('order'));
    }
}
