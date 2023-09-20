<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddRegisteredUserToCart
{
    public function handle(object $event): void
    {
        $cart = Cart::where('session_id', session()->getId())->get();

        if ($cart->isNotEmpty())
        {
            $cart->each(function ($cartItem) use ($event) {
                $cartItem->update(['user_id' => $event->user->id]);
            });
        }
    }
}
