<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Mail\OrderShippMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderShipp
{
    public function handle(object $event): void
    {
        $order = $event->order;
        Mail::to($order->email)->send(new OrderShippMail($order));
    }
}
