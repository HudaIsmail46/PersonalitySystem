<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Customer;
use App\BookingItem;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;

class NewJobAdded extends AafinanceWebhook
{
    public static function handle($data)
    {
        $customer = static::createOrUpdateCustomer($data);
        $booking = new Booking;

        $booking->fill([
            'customer_id' => $customer ? $customer->id : null,
            'created_at' => static::dateFromFormat($data['RequestDate']),
            'event_begins' => static::dateFromFormat($data['AppointmentDateTime']),
            'event_ends' => static::dateFromFormat($data['AppointmentDateTime'])->addMinutes(60*$data['EstimateDuration']),
            'af_reference' => $data['JobId'],
            'remarks' => $data['Remark'] . "\n" . json_encode($data['JobAddtionalCost']),
            'status' => $data['Status'],
            'price' => $data['TotalAmount'] ? $data['TotalAmount'] * 100 : 0,
            'address_1' => $data['StreetAddress1'] || '',
            'address_2' => $data['StreetAddress2'] || '',
            'city' => $data['City'] || '',
            'postcode' => $data['PostCode'] || '',
            'location_state' => $data['State'] || '',
        ]);
        $booking->save();

        $bookingItems = static::createOrUpdateBookingItems($booking, $data['JobItems']);
    }
}
