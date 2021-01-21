<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Invoice;
use App\Booking;

class InvoicePayment extends Model
{
    use SoftDeletes;
    protected $fillable = ['amount', 'receipt_number', 'paid_at', 'payment_method', 'created_by'];
    protected $dates = ['paid_at'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}

// {
//     "SalesInvoicePaymentId":473,
//     "SalesInvoiceId":585,
//     "JobId":813,
//     "ReceiptReferenceNo":"RC000473",
//     "PaymentDate":"2021-01-20T00:00:00",
//     "Amount":320,
//     "PaymentMethod":"Bank transfer",
//     "CreationUser":"Naziratul Aini Binti Hisamudin"
// }