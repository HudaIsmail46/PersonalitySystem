<?php

namespace App\Google;

use Carbon\CarbonInterface;
use Spatie\GoogleCalendar\Event;
use Google_Service_Calendar_Events;

class FetchEvents extends Event
{
    public static function getAll(array $parameters = [], string $calendarId = null): Google_Service_Calendar_Events
    {
        $googleCalendar = static::getGoogleCalendar($calendarId);

        return $googleCalendar
                ->getService()
                ->events
                ->listEvents($calendarId, $parameters);
    }
}
