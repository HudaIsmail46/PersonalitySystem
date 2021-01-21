<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\BookingProduct;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'booking_product_id', 'quantity',
        'description', 'price'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function bookingProduct()
    {
        return $this->belongsTo(BookingProduct::class);
    }
}
