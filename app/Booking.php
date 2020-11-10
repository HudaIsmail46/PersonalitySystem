<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    protected $fillable = ['gc_id','gc_event_title', 'gc_address', 'gc_event_begins',
        'gc_event_ends', 'gc_description', 'gc_team', 'name', 'phone_no', 'status',
        'receipt_number', 'invoice_number', 'gc_price', 'price', 'service_type', 'deposit', 'pic',
        'customer_id','deleted_at'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function path()
    {
        return route('booking.show', $this);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function isComplete()
    {
        return !is_null($this->gc_event_title)
            && !is_null($this->gc_address)
            && !is_null($this->gc_event_begins)
            && !is_null($this->gc_event_ends)
            && !is_null($this->gc_description)
            && !is_null($this->name)
            && !is_null($this->phone_no);
    }

    public function scopeComplete($query)
    {
        return $query->whereNotNull("gc_event_title")
            ->whereNotNull("gc_address")
            ->whereNotNull("gc_event_begins")
            ->whereNotNull("gc_event_ends")
            ->whereNotNull("gc_description")
            ->whereNotNull("name")
            ->whereNotNull("phone_no");
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }
}
