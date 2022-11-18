<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    use HasFactory;

    protected $fillable = [
      'item_id',
      'order_id',
    ];

    protected $table = 'item_order';
}
