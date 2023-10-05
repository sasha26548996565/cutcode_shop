<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistNotEmpty
{
    public function handle(Request $request, Closure $next): Response
    {
        $wishlist = getWishlist();
        if ($wishlist->isEmpty())
        {
            return to_route('index');
        }
        
        return $next($request);
    }
}
