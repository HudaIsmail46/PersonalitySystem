<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarSync extends Model
{
    protected $fillable = ['sync_at' ,'raw_response' ,'sync_token' ,'next_sync_token' ,'calendar_id' ,'sync_token' ,'calendar_id'];

    /**
     * Get the GoogleCalendar.
     */
    public function google_calendar()
    {
        return $this->belongsTo('App\GoogleCalendar');
    }
}
