<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->view('emails.event_registration')
                    ->attachData($this->pdf, 'ticket.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
