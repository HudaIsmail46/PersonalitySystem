<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingProduct extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_id', 'product_name', 'product_code', 'price', 'category',
    'description', 'purchase_cost', 'sell_price', 'job_duration_estimation', 'deleted_at'];

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function bookingProductCategory()
    {
        return $this->belongsTo(BookingProductCategory::class);
    }
}
