<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail']; // Menggunakan saluran email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Membuat URL verifikasi
        $url = $this->verificationUrl($notifiable);

        // Kirim email dengan tampilan kustom
        return (new MailMessage)
            ->subject('Verifikasi Email Anda')
            ->view('vendor.notifications.email', [
                'user' => $notifiable,
                'url' => $url
            ]);
    }

    /**
     * Membuat URL verifikasi untuk email.
     *
     * @param  \Illuminate\Contracts\Auth\MustVerifyEmail  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        if ($notifiable instanceof \App\Models\User) {
            // Menghasilkan URL sementara dengan tanda tangan yang valid, berlaku selama 60 menit
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60), // URL berlaku selama 60 menit
                ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
            );

            return url($verificationUrl);
        }

        // Jika bukan User, bisa melemparkan exception atau return null
        throw new \Exception('Notifiable is not an instance of User.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Representasi array dari notifikasi (jika diperlukan)
        ];
    }
}
