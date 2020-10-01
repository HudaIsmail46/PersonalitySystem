<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Booking;
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
        static::createOrUpdateBookings($response , $calendar->team);
        return true;
    }

    public static function refreshSyncToken(GoogleCalendar $calendar, string $timeMin) : bool
    {
        $parameters = ['timeMin' => $timeMin];
        $response = FetchEvents::getAll($parameters, $calendar->google_calendar_id);
        static::createOrUpdateBookings($response, $calendar->team);
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

    public static function createOrUpdateBookings($response, string $team)
    {
        $events = $response->getItems();
        foreach ($events as $event) {

            $booking = Booking::firstWhere('gc_id', '=', $event->id);
            if (is_null($booking)) {

                $booking = new Booking;
                $booking->gc_id = $event->id;
                $booking->gc_event_title = $event->summary;
                $booking->gc_event_begins = Carbon::createFromFormat(Carbon::ISO8601, $event->start->dateTime)->toDateTimeString();
                $booking->gc_event_ends = Carbon::createFromFormat(Carbon::ISO8601, $event->end->dateTime)->toDateTimeString();
                $booking->gc_description = $event->description;
                $booking->gc_team = $team;
                $booking->gc_address = $event->location;
                $booking->save();
            }       
            else {
                  
                $booking->gc_event_title = $event->summary;
                $booking->gc_event_begins = Carbon::createFromFormat(Carbon::ISO8601, $event->start->dateTime)->toDateTimeString();
                $booking->gc_event_ends = Carbon::createFromFormat(Carbon::ISO8601, $event->end->dateTime)->toDateTimeString();
                $booking->gc_description = $event->description;
                $booking->gc_team = $team;
                $booking->gc_address = $event->location;
                $booking->save();
            }
        }
    }
}
