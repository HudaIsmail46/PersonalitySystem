<?php

namespace App\Imports;

use App\Booking;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class ImportBookings implements ToModel,WithStartRow
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
            'team'  => @$row[5] ,
            ]);

    }

    public function rules(): array
    {
        return [
            '2' =>  Carbon::createFromFormat('Y-m-d H:i:s'),
            '3' =>  Carbon::createFromFormat('Y-m-d H:i:s'),
        ];
    }

    public function startRow() :int
    {
        return 2;
   }
}
