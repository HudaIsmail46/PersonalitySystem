<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use App\Customer;
use Carbon\Carbon;
use App\FollowUp;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;



class FollowUpLeadStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'follow_up_lead_status:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow Up Lead Status(one off script)';

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

        $bookings = Booking::whereDate('created_at','>=', Carbon::now())->get();

        foreach($bookings as $booking)
        {
            $expireAtMonth = 6;
            $voucher_percent = 20;
            if($booking->customer && $booking->customer->currentFollowUp())
            {
                $booking->customer->currentFollowUp()->update([
                    'booking_id' => $booking->id,
                    'expire_at' => $booking->event_begins->addMonths($expireAtMonth)
                ]);
            }
            $followUp = new FollowUp;
            $followUp->fill([
                'booking_id' => $booking->id,
                'customer_id' => $booking->customer_id,
                'expire_at' => $booking->event_begins->addMonths($expireAtMonth),
                'voucher_percent' => $voucher_percent
            ]);
            if($followUp->customer_id)
            {
                $followUp->save();
            }
        }

        $this->info("Done");
    }
}
