<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $transactions;
    public $dtstock;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $transactions, $dtstock)
    {
        $this->user = $user;
        $this->transactions = $transactions;
        $this->dtstock = $dtstock;
    }

    /**
     * Build the message.
     *
     * @return \$this
     */
    public function build()
    {
        return $this->subject('Payment Success Notification')
                    ->view('emails.payment_success');
    }
}