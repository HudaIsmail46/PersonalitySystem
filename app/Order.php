<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable =['size','material','price','prefered_pickup_datetime','actual_length','actual_width','actual_material','actual_price','status'];
    use SoftDeletes;

    public function path()
    {
        return route('order.show', $this);
    }
}