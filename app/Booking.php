<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['gc_id','gc_event_title', 'gc_address', 'gc_event_begins', 'gc_event_ends', 'gc_description', 'gc_team', 'name', 'phone_no', 'status', 'receipt_number', 'invoice_number', 'price', 'service_type', 'deposit'];

    public function path()
    {
        return route('booking.show', $this);
    }

    public function user()
    {
        return $this->belongsTo(Booking::class);
    }
}
