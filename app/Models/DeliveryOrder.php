<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class DeliveryOrder extends Order
{
    protected $fillable = [
        'delivery_fees',
        'customer_name',
        'customer_phone_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (DeliveryOrder $deliveryOrder) {
            $deliveryOrder->forceFill(['type' => Order::TYPE_delivery]);
        });
    }


    protected static function booted()
    {
        static::addGlobalScope(Order::TYPE_delivery, function (Builder $builder) {
            $builder->where('type', Order::TYPE_delivery);
        });
    }
}
