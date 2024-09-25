<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProfileCompletionNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can use other channels like 'database' if needed
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line($this->message)
                    ->action('Complete Profile', url('/profile'))
                    ->line('Thank you for using our application!');
    }
}

