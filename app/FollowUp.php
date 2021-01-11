<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use SoftDeletes;
    protected $fillable = ['gc_id','gc_event_title', 'gc_address', 'gc_event_begins',
        'gc_event_ends', 'gc_description', 'gc_team', 'name', 'phone_no', 'status',
        'receipt_number', 'invoice_number', 'gc_price', 'price', 'service_type',
        'customer_id','deleted_at', 'event_begins', 'event_ends', 'deposit', 'pic',
        'address_1','address_2','address_3','postcode','city','location_state',
        'af_reference', 'remarks', 'team', 'covernote_id', 'aafinance_webhook', 'aafinance_payment','insured_at'];
}
