<?php

namespace App\Notifications\Verification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;

class VerifyScoutEmail extends Notification
{
    use Queueable;

    public $hash;
    public $id;

    /**
     * Create a new notification instance.
     */
    public function __construct($id, $email)
    {
        $this->id = $id;
        $this->hash = Hash::make($email);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->markdown('mail.verification.verify-scout-email', [
            'id' => $this->id,
            'hash' => $this->hash,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
