<?php

namespace App\Notifications;

use Arane\Base\Services\Handlers\SystemService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactMessage extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $fromName, $fromEmail, $subject, $message, $reason, $attachment;

    public function __construct($fromName, $fromEmail, $subject, $message, $reason = null, $attachment = null) {
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
        $this->message = $message;
        $this->attachment = $attachment;
        $this->reason = $reason;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $notification = (new MailMessage)
            ->from($this->fromEmail, $this->fromName)
            ->subject($this->subject);

        if ($this->reason !== null) {
            $notification->line('Reason:')
                ->line($this->reason);
        }


        $notification->line('Message:')
            ->line($this->message);

        if ($this->attachment !== null) {
            $notification->line('Attachments:')
                ->attach($this->attachment);
        }

        return $notification;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
