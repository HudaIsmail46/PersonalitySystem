<?php

namespace App\Imports;

use App\Booking;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBookings implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Booking([
            'event_title'  => @$row[0],
            'address' => @$row[1], 
            'event_begins'      => @$row[2],
            'event_ends' => @$row[3],
            'description'   => @$row[4],
            'team'  => @$row[5]        
            ]);
    }
}
