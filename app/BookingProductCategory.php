<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingProductCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'weightage', 'deleted_at'];

    public function bookingProducts()
    {
        return $this->hasMany(BookingProduct::class);
    }
}
