<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartNotEmpty
{
    public function handle(Request $request, Closure $next): Response
    {
        $cart = Cart::where('session_id', session()->getId())->first();

        if (is_null($cart))
        {
            return back();
        }
        
        return $next($request);
    }
}
