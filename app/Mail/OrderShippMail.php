<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShippMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public readonly Order $order;
    
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.order-shipp-mail',
        );
    }

    public function build()
    {
        return $this->markdown('mail.order-shipp-mail');
    }
}
