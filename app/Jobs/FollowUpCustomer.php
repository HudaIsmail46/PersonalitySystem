<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Booking;
use App\FollowUp;

class FollowUpCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $booking = $this->booking;
        if (!$booking->followUp) {
            if ($booking->customer->currentFollowUp()) {
                $booking->customer->currentFollowUp()->update([
                    'lead_status' => 'CLOSED'
                ]);
            }
    
            $followUp = new FollowUp;
            $followUp->fill([
                'booking_id' => $booking->id,
                'customer_id' => $booking->customer_id,
                'expire_at' => $booking->event_begins->addMonths(6)
            ]);
            $followUp->save();
        }
    }
}
