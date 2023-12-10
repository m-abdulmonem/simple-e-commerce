<?php

namespace Modules\Orders\app\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Auth\app\Models\User;

class OrderNotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;



    public User $user;
    public \stdClass $details;

    /**
     * Create a new event instance.
     */
    public function __construct($details, $user)
    {
        $this->details = (object)$details;
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('notifications.1');
    }

    public function broadcastAs(): string
    {
        return 'my-event';
    }
}
