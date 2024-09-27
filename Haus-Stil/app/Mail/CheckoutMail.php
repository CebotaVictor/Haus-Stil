<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $checkoutData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($checkoutData)
    {
        $this->checkoutData = $checkoutData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Checkout Confirmation')
                    ->view('TestViews.checkout');
    }
}
