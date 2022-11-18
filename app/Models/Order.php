<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const TYPE_dine_in = 'dine-in';
    const TYPE_delivery = 'delivery';
    const TYPE_takeaway = 'takeaway';

    protected $fillable = [
        'type',
    ];

    public static function getTypes(){
        return [self::TYPE_dine_in,self::TYPE_delivery, self::TYPE_takeaway];
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_order');
    }

}
