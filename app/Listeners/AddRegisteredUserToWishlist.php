<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Collection;

class AddRegisteredUserToWishlist
{   
    public function handle(object $event): void
    {
        $items = Wishlist::where('session_id', session()->getId())->get();

        if ($items->isNotEmpty()) {
            $items->each(function ($item) use ($event) {
                $item->update(['user_id' => $event->user->id]);
            });
        }
    }
}
