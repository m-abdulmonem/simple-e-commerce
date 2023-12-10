<?php

namespace Modules\Products\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->product_id ?? $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'image' => asset($this->image),
        ];
    }
}
