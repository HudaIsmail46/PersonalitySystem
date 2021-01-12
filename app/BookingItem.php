<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingItem extends Model
{
    use SoftDeletes;
    protected $fillable = ['booking_id', 'aafinance_webhook', 'quantity', 'price', 'aafinance_reference',
        'remark', 'deleted_at' ,'booking_product_id'];

    protected $casts = ['aafinance_webhook' => 'array'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bookingProduct()
    {
        return $this->belongsTo(BookingProduct::class);
    }
}
