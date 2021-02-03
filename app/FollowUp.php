<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class FollowUp extends Model
{
    use SoftDeletes;
    protected $fillable = ['booking_id','customer_id','lead_status',
        'follow_up_status','sales_person','sms_1','sms_2','sms_3',
        'voucher_percent', 'expire_at'];

    const SALES_PERSON = ['CS1', 'CS2', 'CS3', 'CS4', 'CS5', 'CS6', 'CS7', 'CS8', 'CS9', 'CS10'];
    const SALES_PERSON_ROTATION = ['CS3', 'CS4', 'CS6', 'CS8','CS9', 'CS10'];
    const STATUS = ['NO RESPONSE', 'IN PROGRESS', 'DONE'];//this is follow up status
    // lead status = open or closed, default is closed
    protected $dates = ['expire_at'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function scopeActive($query)
    {
        return $query->whereDate('expire_at', '>=', Carbon::now());
    }

    public function scopeNotClosed($query)
    {
        return $query->where('lead_status', '!=', 'CLOSED');
    }

    // 1st sms 20 days left before expiry
    // 2nd sms 15 days left  /5days after first sms
    // 3rd sms 10 days left  / 5 days after second sms
    // 4th sale person follow up / 8 days left /3 days after sms

    public function scopeDueFirstSms($query)
    {
        return $query->whereDate('expire_at', Carbon::now()->addDays(20))
            ->notClosed();
    }

    public function scopeDueSecondSms($query)
    {
        return $query->whereDate('expire_at', Carbon::now()->addDays(15))
            ->notClosed();
    }

    public function scopeDueThirdSms($query)
    {
        return $query->whereDate('expire_at', Carbon::now()->addDays(10))
            ->notClosed();
    }

    public function scopefirstVoucher($query)
    {
        return $query->where('voucher_percent', 20);
    }

    public function scopeSecondVoucher($query)
    {
        return $query->where('voucher_percent', 15);
    }
}