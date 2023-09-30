<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class AddRegisteredUserToCart
{
    public function handle(object $event): void
    {
        $items = $this->getItems();

        if ($items->isNotEmpty()) {
            $items->each(function ($item) use ($event) {
                $item->update(['user_id' => $event->user->id]);
            });
        }
    }

    private function getItems(): Collection
    {
        return Cart::where('session_id', session()->getId())->get();
    }
}
