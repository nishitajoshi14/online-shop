<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $amount;

    public function __construct($user, $amount)
    {
        $this->user = $user;
        
        $this->amount = $amount;
    }

    public function build()
    {
        return $this->view('emails.orderConfirmation')
                    ->with([
                        'user' => $this->user,
                        'amount' => $this->amount,
                    ]);
    }
}
