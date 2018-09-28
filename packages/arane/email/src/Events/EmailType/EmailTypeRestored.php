<?php

namespace Arane\Email\Events\EmailType;

use Arane\Base\Events\ModelEvent;


class EmailTypeRestored extends ModelEvent {
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($emailType) {
        parent::__construct($emailType);
    }
}
