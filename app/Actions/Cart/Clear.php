<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class Clear
{
    public function handle(): void
    {
        Cart::where('session_id', session()->getId())
            ->orWhere('user_id', optional(Auth::user())->id)
            ->delete();
    }
}
