<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['event_title','address','event_begins','event_ends','description','team'];
    
    public function path()
    {
        return route('booking.index', $this);
    }

    public function user()
    {
       return $this->belongsTo(Booking::class);
    }
}

