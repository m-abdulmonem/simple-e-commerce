<?php

namespace Modules\Orders\app\Events;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderNotifyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public \stdClass $details;

    /**
     * Create a new event instance.
     */
    public function __construct($details)
    {
        $this->details = (object)$details;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        return ['notifications'];
    }

    public function broadcastAs(): string
    {
        return 'my-event';
    }
}
