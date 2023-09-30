<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Database\Eloquent\Collection;

abstract class BaseUpdateUserId
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

    abstract protected function getItems(): Collection;
}
