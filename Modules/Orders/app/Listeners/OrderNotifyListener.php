<?php

namespace Modules\Orders\app\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Notifications\app\Models\Notification;
use Modules\Orders\app\Events\OrderNotifyEvent;

class OrderNotifyListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderNotifyEvent $event): void
    {
        Notification::create([
            'order_id' => $event->details->order_id,
            'title' => $event->details->title,
            'content' => ['user_id' => 1],
        ]);
    }
}
