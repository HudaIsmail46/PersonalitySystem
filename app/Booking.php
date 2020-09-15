<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['event_title', 'address', 'event_begins', 'event_ends', 'description', 'team', 'name' , 'phone_no'];

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
        $pattern = "/(?:(?:\+6?([1-9]|[0-9][0-9]|[0-9][0-9][0-9])\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)?/";
        $output = [];
        $match = preg_match($pattern, $phone, $output);
        if($match == 0){
            return null;
        }
        else{
        return $output[0];
        }
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function(Booking $model)
        {
            $model->name = $model->getCustomerName()->touch();
            dd($model->save()); 
        });       
    }
}
