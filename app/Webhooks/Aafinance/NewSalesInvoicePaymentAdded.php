<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;
use App\Jobs\ReportBooking;

class NewSalesInvoicePaymentAdded extends AafinanceWebhook
{
    public static function handle($data)
    {
        $booking = Booking::firstWhere('af_reference',  $data['JobId']);
        if ($booking) {
            $booking->fill([
                "aafinance_payment" => $data,
                "receipt_number" => $data['ReceiptReferenceNo']
            ]);

            $booking->save();

            ReportBooking::dispatch($booking);
        }
    }
}
