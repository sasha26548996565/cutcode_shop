<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartObserver
{
    public function creating(Cart $cart): void
    {
        if (Auth::user() != null)
        {
            $cart->user_id = Auth::user()->id;
        }
    }

    public function updating(Cart $cart): void
    {
        if (is_null($cart->user_id) && Auth::user() != null)
        {            
            $cart->user_id = Auth::user()->id;
        }
    }
}
