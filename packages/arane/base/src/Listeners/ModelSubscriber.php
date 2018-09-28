<?php

namespace Arane\Base\Listeners;

use Arane\Log\Services\Handlers\LogService;
use Arane\Notification\Models\Entities\NotificationChannel;
use Arane\Notification\Models\Entities\NotificationSubscription;
use Arane\Notification\Services\Handlers\NotificationService;
use Arane\Base\Services\Handlers\SystemService;

class ModelSubscriber {
    
    protected $logService;
    protected $systemService;
    protected $notificationService;
    
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
    public function __construct(LogService $logService, SystemService $systemService, NotificationService $notificationService) {
        $this->logService = $logService;
        $this->systemService = $systemService;
        $this->notificationService = $notificationService;
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events) {
        
        $events->listen(
            'Arane\Base\Events\ModelCreated',
            'Arane\Base\Listeners\ModelSubscriber@onModelCreated'
        );
        
        $events->listen(
            'Arane\Base\Events\ModelUpdated',
            'Arane\Base\Listeners\ModelSubscriber@onModelUpdated'
        );
        
        $events->listen(
            'Arane\Base\Events\ModelDeleted',
            'Arane\Base\Listeners\ModelSubscriber@onModelDeleted'
        );
        
        $events->listen(
            'Arane\Base\Events\ModelRestored',
            'Arane\Base\Listeners\ModelSubscriber@onModelRestored'
        );
    }
    
    public function onModelCreated($event) {
        if (isset($event->model)) {
            $this->log($event, 'create');
            $this->notify($event, 'create');
        }
    }
    
    public function onModelUpdated($event) {
        $this->log($event, 'update');
        //$this->notify($event, 'update');
    }
    
    public function onModelDeleted($event) {
        if ($event->model->isForceDeleting()) {
            $this->log($event, 'hard-delete');
            //$this->notify($event, 'hard-delete');
        } else {
            $this->log($event, 'delete');
            //$this->notify($event, 'delete');
        }
        
    }
    
    public function onModelRestored($event) {
        $this->log($event, 'restore');
        //$this->notify($event, 'restore');
    }
    
    //SECONDARY FUNCTIONS
    
    public function log($event, $action) {
        if (auth()->check()) {
            $modelName = strtolower((new \ReflectionClass(get_class($event->model)))->getShortName());
            $user = auth()->user();
            $this->logService->create([
                'user_id' => $user->id, 'service' => $modelName, 'action' => $action . ' ' . $modelName,
                'date' => $this->systemService->now(), 'result' => 'success',
                'message' => trans('events.responses.' . $action . '.success.message', ['id' => $event->model->id, 'modelName' => $modelName])
            ]);
        }
    }
    
    public function notify($event, $action) {
        
        if (auth()->check()) {
            
            $modelName = strtolower((new \ReflectionClass(get_class($event->model)))->getShortName());
            
            $channelTypes = $this->systemService->channelTypes();
            
            $user = auth()->user();
            
            $channel = NotificationChannel::where('name', $modelName)->first();
            
            if (isset($channel)) {
                
                foreach ($channelTypes as $channelType) {
                    
                    $subscribedUserIds = NotificationSubscription::where(['channel_id' => $channel->id, $channelType . '_subscribed' => 1])->pluck('user_id')->toArray();
                    
                    $recipients = User::whereIn('id', $subscribedUserIds)->get();
                    
                    
                    if ($recipients->count()) {
                        
                        $this->notificationService->send([
                            'format' => $channelType,
                            'email' => [
                                'subject' => trans('events.notifications.' . $action . '.success.subject', ['id' => $event->model->id, 'modelName' => $modelName, 'userId' => $user->id, 'userName' => $user->fullname]),
                                'message' => trans('events.notifications.' . $action . '.success.message', ['id' => $event->model->id, 'modelName' => $modelName, 'userId' => $user->id, 'userName' => $user->fullname]),
                            ],
                            'model' => [
                                'type' => 'model',
                                'name' => $modelName,
                                'value' => $event->model,
                                'action' => $action,
                            ],
                        ], $recipients);
                    }
                }
            }
        }
        
    }
}
