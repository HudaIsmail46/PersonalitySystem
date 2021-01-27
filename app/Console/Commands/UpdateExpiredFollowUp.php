<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FollowUp;
use Carbon\Carbon;

class UpdateExpiredFollowUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired_follow_up:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update follow up that expire ';

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
        $follow_ups = FollowUp::whereDate('expire_at', '=', Carbon::now()->subDays(1))
            ->where('lead_status', '!=', 'CLOSED')
            ->get();
        foreach($follow_ups as $follow_up){
            $follow_up->update(['lead_status' => 'NOT CLOSED']);
            if ($follow_up->voucher_percent == 20) {//means that customer is elligible for second voucher
                $new_follow_up = new FollowUp;
                $new_follow_up->fill([
                    'booking_id' => $follow_up->booking_id,
                    'customer_id' => $follow_up->customer_id,
                    'expire_at' => $follow_up->booking->event_begins->addYears(1),
                    'voucher_percent' => 15
                ]);
                $new_follow_up->save();
            }
        }
        return 0;
    }

}
