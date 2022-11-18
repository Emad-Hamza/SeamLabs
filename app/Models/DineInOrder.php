<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class DineInOrder extends Order
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function(DineInOrder $dineInOrder){
            $dineInOrder->forceFill(['type' => Order::TYPE_dine_in]);
        });
    }


    protected static function booted()
    {
        static::addGlobalScope(Order::TYPE_dine_in, function (Builder $builder){
            $builder->where('type', Order::TYPE_dine_in);
        });
    }}
