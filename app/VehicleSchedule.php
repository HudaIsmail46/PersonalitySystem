<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleSchedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date', 'vehicles', 'total_vehicles'
    ];

    protected $dates =[
        'date'
    ];

    protected $casts =['vehicles' =>'array'];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}