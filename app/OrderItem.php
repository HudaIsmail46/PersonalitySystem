<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    const SIZES = ['s', 'm', 'l'];
    const MATERIALS = ['wool', 'cotton', 'silk', 'synthetic'];

    protected $fillable = [
        'order_id','size', 'material', 'price', 'actual_length',
        'actual_width', 'actual_material', 'actual_price', 'quantity',
        'deleted_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
