<?php

namespace Arane\Email\Listeners;

use Illuminate\Support\Facades\Event;
use Arane\Base\Events\ModelCreated;
use Arane\Base\Events\ModelDeleted;
use Arane\Base\Events\ModelRestored;
use Arane\Base\Events\ModelUpdated;


class EmailTypeSubscriber {
    
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
            ['Arane\Email\Events\EmailType\EmailTypeCreated'],
            'Arane\Email\Listeners\EmailTypeSubscriber@onEmailTypeCreated'
        );
        
        $events->listen(
            ['Arane\Email\Events\EmailType\EmailTypeUpdated'],
            'Arane\Email\Listeners\EmailTypeSubscriber@onEmailTypeUpdated'
        );
        
        $events->listen(
            ['Arane\Email\Events\EmailType\EmailTypeDeleted'],
            'Arane\Email\Listeners\EmailTypeSubscriber@onEmailTypeDeleted'
        );
        
        $events->listen(
            ['Arane\Email\Events\EmailType\EmailTypeRestored'],
            'Arane\Email\Listeners\EmailTypeSubscriber@onEmailTypeRestored'
        );
    }
    
    public function onEmailTypeCreated($event) {
        Event::fire(new ModelCreated($event->model));
    }
    
    public function onEmailTypeUpdated($event) {
        Event::fire(new ModelUpdated($event->model));
    }
    
    public function onEmailTypeDeleted($event) {
        Event::fire(new ModelDeleted($event->model));
    }
    
    public function onEmailTypeRestored($event) {
        Event::fire(new ModelRestored($event->model));
    }
    
}
