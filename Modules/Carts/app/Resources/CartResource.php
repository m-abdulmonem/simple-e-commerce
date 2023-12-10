<?php

namespace Modules\Carts\app\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Products\app\Resources\ProductResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'items' => ProductResource::collection($this->items)
        ];
    }
}
