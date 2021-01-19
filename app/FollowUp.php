<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use SoftDeletes;
    protected $fillable = ['booking_id','customer_id','lead_status','follow_up_status','sales_person','sms_1','sms_2','sms_3'];

    const SALES_PERSON = ['CS1', 'CS2', 'CS3', 'CS4', 'CS5', 'CS6', 'CS7', 'CS8'];
    const STATUS = ['NO RESPONSE', 'IN PROGRESS', 'DONE'];

        public function booking()

   {
        return $this->belongsTo(Booking::class);
    }

    public function customer()

    {
         return $this->belongsTo(Customer::class);
     }
}