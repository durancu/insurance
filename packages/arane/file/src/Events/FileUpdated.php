<?php

namespace Arane\File\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Arane\Base\Events\ModelEvent;

class FileUpdated extends ModelEvent {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($file) {
        parent::__construct($file);
    }
}
