<?php

namespace Arane\Email\Listeners;

use Illuminate\Support\Facades\Event;
use Arane\Base\Events\ModelCreated;
use Arane\Base\Events\ModelDeleted;
use Arane\Base\Events\ModelRestored;
use Arane\Base\Events\ModelUpdated;


class EmailListSubscriber {
    
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
    public function __construct() {
    
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events) {
        $events->listen(
            ['Arane\Email\Events\EmailList\EmailListCreated'],
            'Arane\Email\Listeners\EmailListSubscriber@onEmailListCreated'
        );
        
        $events->listen(
            ['Arane\Email\Events\EmailList\EmailListUpdated'],
            'Arane\Email\Listeners\EmailListSubscriber@onEmailListUpdated'
        );
        
        $events->listen(
            ['Arane\Email\Events\EmailList\EmailListDeleted'],
            'Arane\Email\Listeners\EmailListSubscriber@onEmailListDeleted'
        );
        
        $events->listen(
            ['Arane\Email\Events\EmailList\EmailListRestored'],
            'Arane\Email\Listeners\EmailListSubscriber@onEmailListRestored'
        );
    }
    
    public function onEmailListCreated($event) {
        Event::fire(new ModelCreated($event->model));
    }
    
    public function onEmailListUpdated($event) {
        Event::fire(new ModelUpdated($event->model));
    }
    
    public function onEmailListDeleted($event) {
        Event::fire(new ModelDeleted($event->model));
    }
    
    public function onEmailListRestored($event) {
        Event::fire(new ModelRestored($event->model));
    }
    
}
