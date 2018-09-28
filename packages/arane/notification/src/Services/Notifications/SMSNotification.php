<?php

namespace Arane\Notification\Services\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Lab123\AwsSns\Messages\AwsSnsMessage;
use Lab123\AwsSns\Channels\AwsSnsSmsChannel;

class SMSNotification extends Notification {
    use Queueable;
    protected $message;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message) {
        $this->message = $message;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        return [
            AwsSnsSmsChannel::class
        ];
    }
    
    /**
     * Get the AWS SNS SMS Message representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Lab123\AwsSns\Messages\AwsSnsMessage
     */
    public function toAwsSnsSms($notifiable) {
        return (new AwsSnsMessage())->message($this->message);
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
