<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\InvoiceItem;
use App\Booking;
use App\InvoicePayment;

class Invoice extends Model
{
    use SoftDeletes;
    protected $fillable = ['booking_id', 'afinance_reference', 'invoice_date', 'payer_name',
        'payer_email', 'payer_phone_no', 'total_amount', 'status', 'additions'];
    protected $dates = [ 'invoice_date'];
    protected $casts = ['additions' => 'array'];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

}


// {
//     "SalesInvoiceId":573,
//     "JobId":783,
//     "ReferenceNo":"INV00573",
//     "InvoiceDate":"2021-01-19T00:00:00",
//     "PayerName":"Puan Huda",
//     "PayerEmail":null,
//     "PayerPhoneNumber":"60126799540",
//     "TotalAmount":1350,
//     "SalesInvoiceItems":[
//         {
//             "SalesInvoiceItemId":1198,
//             "Description":"Comprehensive (Misting+Wiping) - Bungalow",
//             "Product":
//                 {
//                     "ProductId":122,"ProductName":"Comprehensive (Misting+Wiping) - Bungalow",
//                     "ProductCode":"408",
//                     "Category":"Microbial Control & Sanitization"
//                 },
//             "Quantity":1,
//             "SellPrice":1500
//         }
//     ],
//     "SalesInvoiceAddtionalCosts":
//         [
//             {
//                 "SalesInvoiceAddtionalCostId":881,
//                 "Description":"Discount 10%",
//                 "Amount":-150
//             }
//         ],
//     "Status":"Paid",
//     "CreationUser":"HQ Hijau"
// }