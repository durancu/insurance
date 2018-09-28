<?php

namespace Arane\Base\Events;

class ModelRestored extends ModelEvent {
    /**
     * Create a new event instance.
     *
     */
    public function __construct($model) {
        parent::__construct($model);
    }
}
