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
            'gc_event_title' => @$row[0],
            'gc_address' => @$row[3],
            'gc_event_begins' => Carbon::createFromFormat("d/m/Y", $row[5])->toDateTimeString(),
            'gc_event_ends' => Carbon::createFromFormat("d/m/Y", $row[5])->toDateTimeString(),
            'gc_description' => @$row[6],
            'gc_team' => @$row[7],
            'name' => @$row[0],
            'phone_no' => @$row[13],
            'status' => @$row[8],
            'receipt_number' => @$row[9],
            'invoice_number' => @$row[10],
            'price' => (int)@$row[19],
            'service_type' => @$row[12],
            ]);

    }

    public function startRow() :int
    {
        return 2;
   }
}
