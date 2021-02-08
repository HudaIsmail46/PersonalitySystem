<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendWhatsapp;
use App\Booking;
use Carbon\Carbon;

class SendJobReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job_reminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send job reminder to customers for tomorrow's job";

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
        $bookings = Booking::whereDate('event_begins', Carbon::now()->addDays(1))
            ->whereNotNull('team')
            ->get();

        foreach($bookings as $booking){
            if ($booking->customer) {
                $phoneNo = "+" . formatPhoneNo($booking->customer->phone_no);
                $msg =" 
Dear Mr/Ms {$booking->customer->name},

You have a slot booked with *CleanHero* as per details below:

Date: *{$booking->event_begins->format('d/m/Y')}*
Time: *{$booking->event_begins->format('H:i')} - {$booking->event_ends->format('H:i')}*
Location: *{$booking->fullAddress()}*

_This is an automated message. Should you require any assistance, do reach out to the Salesperson you booked your service with._

Thank you.

💙 CH Team";
    
                SendWhatsapp::dispatch($phoneNo, $msg);
            }
        }
    }
}
