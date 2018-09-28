<?php

namespace Arane\Email\Listeners;

use Arane\Log\Services\Handlers\LogService;
use Arane\Base\Services\Handlers\SystemService;


class EmailSubscriber {
    
    protected $logService;
    protected $systemService;
    
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';
    
    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(LogService $logService, SystemService $systemService) {
        $this->logService = $logService;
        $this->systemService = $systemService;
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events) {
        $events->listen(
            'Arane\Email\Events\Email\EmailSent',
            'Arane\Email\Listeners\EmailSubscriber@onEmailSent'
        );
    }
    
    public function onEmailSent($event) {
        if (config('arane-email.log-events')) {
            $this->log($event, 'send');
        }
    }
    
    //SECONDARY FUNCTIONS
    
    public function log($event, $action) {
        
        $user = $event->email->from === config('mail.from.from-address') ? $this->systemService->systemSuperAdmin() : auth()->user();;
        
        $to = (is_array($event->email->to)) ? implode(', ', $event->email->to) : $event->email->to;
        
        $this->logService->create([
            'user' => $user->id, 'service' => 'email', 'action' => $action . ' email',
            'date' => $this->systemService->now(), 'result' => 'success',
            'message' => trans('events.responses.' . $action . '.success.message', ['email' => $to])
        ]);
    }
    
}
