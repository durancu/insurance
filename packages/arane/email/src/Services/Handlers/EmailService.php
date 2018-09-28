<?php

namespace Arane\Email\Services\Handlers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail as Mail;
use Arane\Email\Events\Email\EmailSent;
use Arane\Email\Jobs\SendEmail;

class EmailService {

    protected $email;

    //Service instances

    public function __construct() {

    }
    
    
    /**
     * Send email
     * @param array $emailData
     * @param array $messageData
     * @param array $options
     * @return mixed|EmailBuilder
     */
    public function send($emailData, $messageData, $options) {

        $email = new EmailBuilder($emailData, $messageData, $options);
        $email->build();

        $connection = isset($options['connection']) ? $options['connection'] : config('arane-email.connection');
        $queue = isset($options['queue']) ? $options['queue'] : config('arane-email.queue');

        SendEmail::dispatch($email)->onConnection($connection)->onQueue($queue);

        Event::fire(new EmailSent($email));

        return $email;
    }
    
    
    /**
     * @return mixed|void
     */
    public function templates() {
        // TODO: Implement templates() method.
    }
    
    /**
     * @return mixed|void
     */
    public function types() {
        // TODO: Implement types() method.
    }
    
    /**
     * @return mixed|void
     */
    public function lists() {
        // TODO: Implement lists() method.
    }


}
