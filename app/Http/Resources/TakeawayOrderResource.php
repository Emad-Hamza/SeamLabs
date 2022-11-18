<?php

namespace App\Http\Resources;

use App\Models\TakeawayOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class TakeawayOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource instanceof TakeawayOrder) {

            $total = $this->resource->itemsTotalPrice();
            return [
                'id' => $this->id,
                'items' => ItemResource::collection($this->resource->items()->get()),
                'items_total_price' => $this->resource->itemsTotalPrice(),
                'total' => $total,
            ];
        }
    }
}
