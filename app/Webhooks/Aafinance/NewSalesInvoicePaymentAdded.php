<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use Carbon\Carbon;
use App\Invoice;
use App\InvoicePayment;
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

            $payment = new InvoicePayment;
            $payment->fill([
                'invoice_id' => $booking->invoice->id,
                'booking_id' => $booking->id,
                'amount' => $data['Amount'] * 100,
                'receipt_number' => $data['ReceiptReferenceNo'],
                'paid_at' => Carbon::parse($data['PaymentDate']),
                'payment_method' => $data['PaymentMethod'],
                'created_by' => $data['CreationUser']
            ]);
            $payment->save();

            

            ReportBooking::dispatch($booking);
        }
    }
}
