<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Customer;
use App\BookingItem;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;
use App\Jobs\IssueInsurance;

class JobAssignmentAccepted extends AafinanceWebhook
{
    public static function handle($data)
    {
        if ($data['Status'] == "Accepted") {
            $booking = Booking::firstWhere('af_reference',  $data['Job']['JobId']);

            $booking->fill([
                "team" => $data['Agent']['Fullname']
            ]);
            $booking->save();
        }
    }
}
