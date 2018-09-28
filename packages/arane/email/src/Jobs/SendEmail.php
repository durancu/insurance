<?php

namespace Arane\Email\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Arane\Email\Services\Handlers\EmailBuilder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmail implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailBuider;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EmailBuilder $emailBuilder) {
        $this->emailBuider = $emailBuilder;
    }

    /**
     * Execute the job.
     *
     * @param  array $emailData : [from, to, cc, bcc, reply-to, subject, priority, attachments]
     * @param  array $messageData
     * @param  array $options
     *
     * @return void
     */
    public function handle($emailData = [], $messageData = [], $options = []) {

        /*$format = !isset($options['format']) ? 'html' : $options['format'];
        $viewPath = isset($options['view']) ? $options['view'] : 'email::system-notification';

        switch ($format) {

            case 'mixed':
                $view = [$viewPath, $viewPath . '-text'];
                break;

            case 'text':
                $view = ['text' => $viewPath . '-text'];
                break;

            default:
                $view = $viewPath;
        }

        $email = $this->emailBuider;

        Mail::send($view, ['data' => $messageData], function ($message) use ($email) {
        });*/
    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     *
     * @return void
     */
    public function failed(Exception $exception) {
        //TODO: Implement Failed function properly

        //SendEmail::dispatch($this->newEmail)->onConnection($this->emailDTO->connection);
    }
}
