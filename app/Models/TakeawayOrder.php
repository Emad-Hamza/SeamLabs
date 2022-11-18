<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Builder;

class TakeawayOrder extends Order
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function(TakeawayOrder $takeawayOrder){
           $takeawayOrder->forceFill(['type' => Order::TYPE_takeaway]);
        });
    }

    protected static function booted()
    {
        static::addGlobalScope(Order::TYPE_takeaway, function (Builder $builder){
            $builder->where('type', Order::TYPE_takeaway);
        });
    }
}
