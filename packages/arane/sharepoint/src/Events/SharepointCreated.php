<?php

namespace Arane\Sharepoint\Events;

use Arane\Sharepoint\Models\Entities\Sharepoint;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Arane\Base\Events\ModelEvent;

class SharepointCreated extends ModelEvent {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Sharepoint $sharepoint) {
        parent::__construct($sharepoint);
    }
}
