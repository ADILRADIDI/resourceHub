<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    public $data;

    public function __construct($pdf, $data)
    {
        $this->pdf = $pdf;
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.event_registration')
            ->subject('Your Event Registration')
            ->attachData($this->pdf, 'ticket.pdf', [
                'mime' => 'application/pdf',
            ])
            ->with($this->data);
    }
}
