<?php

namespace Arane\Sharepoint\Listeners;

use Arane\Base\Services\Handlers\UserService;
use Arane\Notification\Services\Handlers\NotificationChannelService;
use Arane\Notification\Services\Handlers\NotificationSubscriptionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Event;
use Arane\Base\Events\ModelCreated;
use Arane\Base\Events\ModelDeleted;
use Arane\Base\Events\ModelRestored;
use Arane\Base\Events\ModelUpdated;
use Arane\Log\Services\Handlers\LogService;
use Arane\Base\Services\Handlers\SystemService;
use Arane\Notification\Services\Handlers\NotificationService;

class SharepointSubscriber {
    
    protected $logService;
    protected $systemService;
    protected $userService;
    protected $notificationService;
    protected $notificationChannelService;
    protected $notificationSubscriptionService;
    
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
    public function __construct(LogService $logService, NotificationService $notificationService, SystemService $systemService, UserService $userService, NotificationChannelService $notificationChannelService, NotificationSubscriptionService $notificationSubscriptionService) {
        $this->logService = $logService;
        $this->systemService = $systemService;
        $this->userService = $userService;
        $this->notificationService = $notificationService;
        $this->notificationChannelService = $notificationChannelService;
        $this->notificationSubscriptionService = $notificationSubscriptionService;
    }
    
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events) {
        $events->listen(
            'Arane\Sharepoint\Events\SharepointCreated',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onCreated'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointUpdated',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onUpdated'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointDeleted',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onDeleted'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointRestored',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onRestored'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointCopied',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onCopied'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointMoved',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onMoved'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointShared',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onShared'
        );
        $events->listen(
            'Arane\Sharepoint\Events\SharepointUnshared',
            'Arane\Sharepoint\Listeners\SharepointSubscriber@onUnShared'
        );
    }
    
    /**
     * Handle sharepoint upload file events.
     */
    public function onCreated($event) {
        Event::fire(new ModelCreated($event->model));
    }
    
    /**
     * Handle sharepoint update file events.
     */
    public function onUpdated($event) {
        Event::fire(new ModelUpdated($event->model));
    }
    
    /**
     * Handle sharepoint delete file events.
     */
    public function onDeleted($event) {
        Event::fire(new ModelDeleted($event->model));
    }
    
    /**
     * Handle sharepoint restore file events.
     */
    public function onRestored($event) {
        Event::fire(new ModelRestored($event->model));
    }
    
    //BUSINESS EVENTS
    
    /**
     * Handle sharepoint share file events.
     */
    public function onShared($event) {
        $this->log($event, "share");
        $this->notify($event, "share");
    }
    
    /**
     * Handle sharepoint unshare file events.
     */
    public function onUnShared($event) {
        $this->log($event, "unshare");
        $this->notify($event, "unShare");
    }
    
    /**
     * Handle sharepoint copy file events.
     */
    public function onCopied($event) {
        $this->log($event, "copy");
        $this->notify($event, "copy");
    }
    
    /**
     * Handle sharepoint move file events.
     */
    public function onMoved($event) {
        $this->log($event, "move");
        $this->notify($event, "move");
    }
    
    
    //SECONDARY FUNCTIONS
    
    public function log($event, $action) {
        
        try {
            $modelName = strtolower((new \ReflectionClass(get_class($event->model)))->getShortName());
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Exception on creating new system log. Model ' . $event->model . ' is not a valid model name');
        }
        
        $this->logService->create([
            'user_id' => auth()->id(), 'service' => $modelName, 'action' => $action . ' ' . $modelName,
            'result' => 'success',
            'message' => trans('Arane\Sharepoint::messages.responses.' . $action . '.success.message', ['id' => $event->model->id, 'modelName' => $modelName])
        ]);
    }
    
    public function notify($event, $action) {
        
        try {
            $modelName = strtolower((new \ReflectionClass(get_class($event->model)))->getShortName());
        } catch (\Exception $exception) {
            throw new ModelNotFoundException('Exception on creating new system log: ' . $event->model . ' is not a valid model name');
        }
        
        $channelTypes = $this->systemService->channelTypes();
        
        $user = auth()->user();
        
        $channel = $this->notificationChannelService->model->where('name', $modelName)->first();
        
        if (isset($channel)) {
            
            foreach ($channelTypes as $channelType) {
                
                $subscribedUserIds = $this->notificationSubscriptionService->model->where(['channel_id' => $channel->id, $channelType . '_subscribed' => 1])->pluck('user_id')->toArray();
                
                $recipients = collect($this->userService->model->whereIn('id', $subscribedUserIds)->get());
                
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
