<?php

namespace Arane\Base\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Event;

class ModelEvent extends Event {
    
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    protected $channel = 'model';
    
    public $model;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model) {
        $this->model = $model;
        $this->channel = strtolower((new \ReflectionClass(get_class($this->model)))->getShortName());
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel($this->channel);
    }
    
}
