<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [ 'gc_event_title', 'gc_address', 'gc_event_begins', 'gc_event_ends', 'gc_description', 'gc_team', 'name', 'phone_no', 'status', 'receipt_number', 'invoice_number', 'price', 'service_type',];

    public function path()
    {
        return route('booking.show', $this);
    }

    public function user()
    {
        return $this->belongsTo(Booking::class);
    }

    public function getCustomerName(){
       
        $name = Booking:: select('description')->where('id', $this->id)->get();
        $pattern1= "/(?:Name :|Nama : )([\'|\-|\.+[A-Za-z ]+[.,]?[\'|\-|\.+[A-Za-z])|(?:Name :|Nama : )([\'|\-|\.+[A-Za-z ]+[.,]?[\'|\-|\.|\(+[A-Za-z])+[\)]?/";
        $output = [];
        $match = preg_match($pattern1, $name, $output);
        if($match == 0){
            return null;
        }
        else{
        return $output[1];
        }        
    }

    public function getPhoneNumber(){
       
        $phone = Booking:: select('description')->where('id', $this->id)->get();
        $pattern = "/(?:(?:\+6?|([1-9]|[0-9][0-9 ]|[0-9][0-9][0-9])\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([0-9][1-9]|[0-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/";
        $output = [];
        $match = preg_match($pattern, $phone, $output);
        if($match == 0){
            return null;
        }
        else{
        return $output[0];
        }
    }
}
