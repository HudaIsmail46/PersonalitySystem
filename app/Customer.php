<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 'name', 'phone_no','address',];

    public function path()
    {
        return route('customer.show', $this);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

