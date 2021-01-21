<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Invoice;
use App\Booking;

class InvoicePayment extends Model
{
    use SoftDeletes;
    protected $fillable = ['invoice_id','booking_id', 'amount', 'receipt_number',
        'paid_at', 'payment_method', 'created_by'];
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
