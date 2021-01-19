<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    protected $fillable = [ 'name', 'phone_no', 'address_1', 'address_2', 'address_3', 'postcode', 'city', 'location_state', 'gender', 'nric', 'email'];

    use SoftDeletes;

    public function path()
    {
        return route('customer.show', $this);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function followUp()
    {
        return $this->hasMany(FollowUp::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public static function findOrCreate($name, $phone_no)
    {
        $customer = null;
        if ($phone_no){
            $customer = static::firstWhere('phone_no', '=', $phone_no);
            if (is_null($customer)) {
                $customer = new static;
                $customer->name = $name ? $name : $phone_no;
                $customer->phone_no = $phone_no;
                $customer->save();
            }
        }

        return $customer;
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            foreach ($customer->orders()->get() as $orders) {
                $orders->delete();
            }
            foreach ($customer->bookings()->get() as $bookings) {
                $bookings->delete();
            }
        });
    }
}