<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\ImportGoogleCalendar;
use App\GoogleCalendar;

class ImportGoogleCalendars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google_calendar:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import events from google calendar';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $calendars = GoogleCalendar::with('calendar_syncs')->where('sync', true)->get();
        foreach ($calendars as $calendar) {
            $next_sync_token = $calendar->calendar_syncs->last()->next_sync_token;
            if (is_null($next_sync_token)) {
                $this->info("Calendar #{$calendar->id} is skipped. Missing next_sync_token.");
                continue;
            }
            ImportGoogleCalendar::syncEvents($calendar, $next_sync_token);
        }
        $this->info("Done");
        return 0;
    }
}
