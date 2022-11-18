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
        if ($this instanceof TakeawayOrder) {

            $total = $this->itemsTotalPrice();
            return [
                'id' => $this->id,
                'items' => $this->items(),
                'items_total_price' => $this->itemsTotalPrice(),
                'total' => $total,
            ];
        }
    }
}
