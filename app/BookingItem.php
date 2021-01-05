<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingItem extends Model
{
    use SoftDeletes;
    protected $fillable = ['booking_id', 'aafinance_webhook', 'quantity', 'price', 'aafinance_reference',
        'remark', 'deleted_at'];

    protected $casts = ['aafinance_webhook' => 'array'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
