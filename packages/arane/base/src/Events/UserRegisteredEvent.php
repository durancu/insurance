<?php

namespace Arane\Base\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Arane\Base\Models\Entities\User;
use Arane\Base\Notifications\UserRegisteredNotification;
use Lab123\AwsSns\Exceptions\CouldNotSendNotification;

class UserRegisteredEvent {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user) {
        try {
            $user->notify(new UserRegisteredNotification($user));
        } catch (\Exception $exception){
            throw new CouldNotSendNotification('Error notifying newly registered user');
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('users');
    }
}
