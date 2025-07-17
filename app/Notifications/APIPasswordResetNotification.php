<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class APIPasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $reset_token;

    public function __construct($reset_token)
    {
        $this->reset_token = \Str::upper($reset_token);
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line('A password reset for the account associated with this email has been requested.')
            ->line('Please enter the code below in your password reset page')
            ->line("<strong>{$this->reset_token}</strong>")
            ->line('If you did not request a password reset, please ignore this message')
            ->subject('healthcare.lk - Password reset request');
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
