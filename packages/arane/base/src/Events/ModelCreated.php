<?php

namespace Arane\Base\Events;

class ModelCreated extends ModelEvent {

    /**
     * Create a new event instance.
     *
     */
    public function __construct($model) {
        parent::__construct($model);
    }
    
}
