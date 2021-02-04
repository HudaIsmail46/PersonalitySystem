<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Customer;
use App\BookingItem;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;
use App\Jobs\IssueInsurance;
use App\Jobs\ReportBooking;

class JobAssignmentCreated extends AafinanceWebhook
{
    public static function handle($data)
    {
        $booking = Booking::firstWhere('af_reference',  $data['Job']['JobId']);
        if ($booking) {
            $booking->fill([
                "team" => $data['Agent']['Fullname']
            ]);
            $booking->save();
    
            ReportBooking::dispatch($booking);
        }
    }
}
