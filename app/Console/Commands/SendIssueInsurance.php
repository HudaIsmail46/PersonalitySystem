<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\IssueInsurance;
use App\Booking;
use Carbon\Carbon;

class SendIssueInsurance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue_insurance:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send IssueInsurance';

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
        $bookings = Booking::whereDate('event_begins',Carbon::now()->subDays(3)->toDateTimeString())->get();
        foreach($bookings as $booking){
            if($booking->team) {

                $issueInsurance = new IssueInsurance($booking);
                $issueInsurance ->handle();
                $this->info("Done");

            }

        }
    }
}