<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable =['size','material','price','prefered_pickup_datetime','actual_length',
        'actual_width','actual_material','actual_price','status', 'customer_id'];
    use SoftDeletes;

    const SIZES = ['s', 'm', 'l'];
    const MATERIALS = ['wool', 'cotton', 'silk', 'synthetic'];
    const STATUSES = ['draft', 'scheduled', 'in_progress', 'rescheduled', 'completed', 'cancelled'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }
}
