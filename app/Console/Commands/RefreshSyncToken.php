<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\GoogleCalendar;
use Carbon\Carbon;
use App\Imports\ImportGoogleCalendar;

class RefreshSyncToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google_calendar:refresh_token {--calendarId= : GoogleCalendar id} {--timeMin= : timeMin parameters eg 2011-06-03T10:00:00Z}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get latest events and next_sync_token';

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
        $calendarId = $this->option('calendarId');
        $timeMin = $this->option('timeMin');

        $calendar = GoogleCalendar::find($calendarId);
        if (is_null($calendar)) {
            $this->error('Calendar Not Found');
            return 0;
        }

        if (is_null($timeMin)) {
            $timeMin = Carbon::now()
                ->addHour(-1)
                ->toRfc3339String();
        }

        ImportGoogleCalendar::refreshSyncToken($calendar, $timeMin);
        $this->info("Done");
        return 0;
    }
}
