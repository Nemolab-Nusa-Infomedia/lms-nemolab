<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CustomVerifyEmailNotification extends Notification
{
    use Queueable;

    protected $pin;
    protected $expires_at;
    protected $isPasswordVerification;

    /**
     * Create a new notification instance.
     */
    public function __construct($isPasswordVerification = false)
    {
        $this->pin = Str::random(4);
        $this->expires_at = now()->addMinutes(2);
        $this->isPasswordVerification = $isPasswordVerification;
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
        $notifiable->verification_pin = $this->pin;
        $notifiable->pin_expires_at = $this->expires_at;
        $notifiable->save();

        $template = $this->isPasswordVerification ? 'vendor.notifications.emailPass' : 'vendor.notifications.email';

        return (new MailMessage)
            ->subject('Verifikasi Email Anda')
            ->view($template, [
                'user' => $notifiable,
                'pin' => $this->pin,
                'expires_at' => $this->expires_at
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
            'pin' => $this->pin,
            'expires_at' => $this->expires_at
        ];
    }
}