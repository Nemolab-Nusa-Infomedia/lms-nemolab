<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendSubmissionMentorNotification extends Notification
{
    use Queueable;

    public $submission;
    public $link;

    /**
     * Create a new notification instance.
     */
    public function __construct($submission, $link)
    {
        $this->submission = $submission;
        $this->link = $link;
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
        // Kirim email menggunakan view Blade custom
        return (new MailMessage)
            ->subject('Status Pengajuan Mentor Anda Diperbarui')
            ->view('vendor.notifications.mentor_submission', [
                'user' => $notifiable,
                'status' => $this->submission->status,
                'link' => $this->link
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
