<?php

namespace App\Http\Resources;

use App\Models\DineInOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class DineInOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->resource instanceof DineInOrder) {

            $total = $this->resource->itemsTotalPrice() + $this->service_charge;
            return [
                'id' => $this->id,
                'table_number' => $this->table_number,
                'waiter_name' => $this->waiter_name,
                'items' => ItemResource::collection($this->resource->items()->get()),
                'items_total_price' => $this->resource->itemsTotalPrice(),
                'service_charge' => $this->service_charge,
                'total' => $total,
            ];
        }
    }
}
