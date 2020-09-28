<?php

namespace App\Imports;

use App\Google\FetchEvents;
use DateTime;
use App\CalendarSync;
use App\GoogleCalendar;

class ImportGoogleCalendar
{
    public static function syncEvents(GoogleCalendar $calendar, string $syncToken) : bool
    {
        $parameters = ['syncToken' => $syncToken];
        $response = FetchEvents::getAll($parameters, $calendar->google_calendar_id);

        static::logSync($response, $calendar, $syncToken);
        // static::createOrUpdateBookings()
        return true;
    }

    public static function refreshSyncToken(GoogleCalendar $calendar, string $timeMin) : bool
    {
        $parameters = ['timeMin' => $timeMin];
        $response = FetchEvents::getAll($parameters, $calendar->google_calendar_id);
        // static::createOrUpdateBookings()
        static::logSync($response, $calendar);
        return true;
    }

    public static function logSync($response, GoogleCalendar $calendar, string $syncToken=null)
    {
        $calendarSync = new CalendarSync;
        $calendarSync->raw_response = json_encode($response);
        $calendarSync->sync_token = $syncToken;
        $calendarSync->sync_at = new DateTime;
        $calendarSync->next_sync_token = $response->getNextSyncToken();
        $calendarSync->google_calendar_id = $calendar->id;
        $calendarSync->calendar_id = $calendar->google_calendar_id;

        $calendarSync->save();
    }
}
