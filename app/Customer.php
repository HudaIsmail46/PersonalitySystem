<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 'name', 'phone_no','address', 'gender', 'nric', 'email'];

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
}
