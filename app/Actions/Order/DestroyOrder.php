<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\Models\Order;

class DestroyOrder
{
    public function handle(Order $order): void
    {
        $order->delete();
    }
}