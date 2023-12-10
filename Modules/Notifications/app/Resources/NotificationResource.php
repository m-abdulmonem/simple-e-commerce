<?php

namespace Modules\Notifications\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'is_read' => $this->is_read,
            'title' => $this->title,
            'user' => $this->content['user_id']
        ];
    }
}
