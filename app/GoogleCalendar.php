<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleCalendar extends Model
{
    /**
     * Get the sync
     */
    public function calendar_syncs()
    {
        return $this->hasMany('App\CalendarSync');
    }
}
