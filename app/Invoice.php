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
