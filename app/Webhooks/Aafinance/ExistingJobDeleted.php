<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Customer;
use App\BookingItem;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;

class ExistingJobDeleted extends AafinanceWebhook
{
    public static function handle($data)
    {
        $booking = Booking::firstWhere('af_reference',  $data['Id']);

        foreach($booking->bookingItems as $bookingItem){
            $bookingItem->delete();
        }
        $booking->delete();
    }
}
