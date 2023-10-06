<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartObserver
{
    public function creating(Cart $cart): void
    {
        $cart->load('product');
        $cart->price = (int)($cart->product->price * 100) * $cart->quantity;

        if (Auth::user() != null)
        {
            $cart->user_id = Auth::user()->id;
        }
    }

    public function updating(Cart $cart): void
    {
        $cart->load('product');
        $cart->price = (int)($cart->product->price * 100) * $cart->quantity;
        
        if (is_null($cart->user_id) && Auth::user() != null)
        {            
            $cart->user_id = Auth::user()->id;
        }
    }
}
