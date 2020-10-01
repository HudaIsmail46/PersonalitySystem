<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleCalendar extends Model
{
    protected $fillable = ['name' ,'google_calendar_id' ,'team' ,'sync'];
    /**
     * Get the sync
     */
    public function calendar_syncs()
    {
        return $this->hasMany('App\CalendarSync');
    }
}
