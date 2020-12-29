<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Customer;
use App\BookingItem;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;

class ExistingJobEdited extends AafinanceWebhook
{
    public static function handle($data)
    {
        $customer = static::createOrUpdateCustomer($data);
        $booking = Booking::firstWhere('af_reference',  $data['JobId']);
        if (!$booking) {
            $booking = new Booking;
            $booking->fill(['af_reference' => $data['JobId']]);
        }
        $booking->fill([
            'customer_id' => $customer ? $customer->id : null,
            'created_at' => static::dateFromFormat($data['RequestDate']),
            'event_begins' => static::dateFromFormat($data['AppointmentDateTime']),
            'event_ends' => static::dateFromFormat($data['AppointmentDateTime'])->addMinutes(60*$data['EstimateDuration']),
            'remarks' => $data['Remark'] . "\n" . json_encode($data['JobAddtionalCost']),
            'status' => $data['Status'],
            'price' => $data['TotalAmount'] ? $data['TotalAmount'] * 100 : 0,
            'address_1' => $address_1,
            'address_2' => $address_2,
            'city' => $city,
            'postcode' => $postcode,
            'location_state' => $location_state,
        ]);
        $booking->save();

        $bookingItems = static::createOrUpdateBookingItems($booking, $data['JobItems']);
    }
}
