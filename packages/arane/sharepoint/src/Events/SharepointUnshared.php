<?php

namespace Arane\Sharepoint\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Arane\Base\Events\ModelEvent;
use Arane\Sharepoint\Models\Entities\Sharepoint;

class SharepointUnshared extends ModelEvent {
    use Dispatchable, SerializesModels;
    
    public $sharepoint;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sharepoint $sharepoint) {
        parent::__construct($sharepoint);
    }
}
