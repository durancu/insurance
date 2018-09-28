<?php

namespace Arane\File\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Arane\Base\Events\ModelEvent;

class FileCreated extends ModelEvent {
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($file) {
        parent::__construct($file);
    }
}
