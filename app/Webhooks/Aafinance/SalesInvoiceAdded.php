<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Invoice;
use App\InvoiceItem;
use App\BookingProduct;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;
use App\Jobs\ReportBooking;

class SalesInvoiceAdded extends AafinanceWebhook
{
    public static function handle($data)
    {
        $booking = Booking::firstWhere('af_reference',  $data['JobId']);
        if ($booking) {
            
            $booking->fill([
                "aafinance_invoice" => $data,
                "invoice_number" => $data['ReferenceNo'],
            ]);

            $booking->save();

            $invoice = $booking->invoice ? $booking->invoice : new Invoice;
            $invoice->fill([
                'booking_id' => $booking->id,
                'afinance_reference' => $data['ReferenceNo'],
                'invoice_date' => \Carbon\Carbon::parse($data['InvoiceDate']),
                'payer_name'=> $data['PayerName'],
                'payer_email'=> $data['PayerEmail'],
                'payer_phone_no'=> $data['PayerPhoneNumber'],
                'total_amount'=> $data['TotalAmount'] * 100,
                'status'=> $data['Status'],
                'additions'=> $data['SalesInvoiceAddtionalCosts']
            ]);

            $invoice->save();

            $invoice->invoiceItems()->delete();
            foreach($data['SalesInvoiceItems'] as $item){
                
                $invoiceItem = new InvoiceItem;
                $invoiceItem->fill([
                    'invoice_id'=> $invoice->id,
                    'booking_product_id'=> BookingProduct::firstWhere('product_id', $item['Product']['ProductId'])->id,
                    'quantity'=> $item['Quantity'],
                    'description'=> $item['Description'],
                    'price'=> $item['SellPrice'] * 100
                ]);
                $invoiceItem->save();
            }

            ReportBooking::dispatch($booking);
        }
    }
}
