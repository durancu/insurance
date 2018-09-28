<?php

namespace Arane\Email\Events\EmailList;

use Arane\Base\Events\ModelEvent;

class EmailListUpdated extends ModelEvent {
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($emailList) {
        parent::__construct($emailList);
    }
}
