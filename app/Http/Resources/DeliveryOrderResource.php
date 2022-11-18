<?php

namespace App\Http\Resources;

use App\Models\DeliveryOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if ($this->resource instanceof DeliveryOrder) {
            $total = $this->itemsTotalPrice() + $this->delivery_fees;
            return [
                'id' => $this->id,
                'customer_name' => $this->customer_name,
                'customer_phone_number' => $this->customer_phone_number,
                'items' => ItemResource::collection($this->items()->get()),
                'items_total_price' => $this->itemsTotalPrice(),
                'delivery_fees' => $this->delivery_fees,
                'total' => $total,
            ];
        }
    }
}
