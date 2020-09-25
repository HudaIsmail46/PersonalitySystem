<?php

namespace App\Imports;

use App\Google\FetchEvents;
use DateTime;
use App\CalendarSync;

class ImportGoogleCalendar
{
    public static function syncEvents(string $calendarId, string $syncToken) : bool
    {
        $parameters = ['syncToken' => $syncToken];
        $response = FetchEvents::getAll($parameters, $calendarId);

        static::logSync($response, $calendarId, $syncToken);
        // static::createOrUpdateBookings()
        return true;
    }

    public static function logSync($response, string $calendarId, string $syncToken)
    {
        $calendarSync = new CalendarSync;
        $calendarSync->raw_response = json_encode($response);
        $calendarSync->sync_token = $syncToken;
        $calendarSync->sync_at = new DateTime;
        $calendarSync->next_sync_token = $response->getNextSyncToken();
        $calendarSync->calendar_id = $calendarId;

        $calendarSync->save();
    }
}

// App\Imports\ImportGoogleCalendar::syncEvents('ohc81dj0j5igvqpch4j3b4768c@group.calendar.google.com', "CIj0_umVgewCEIj0_umVgewCGAE=")