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
            'ga_event_title' => @$row[0],
            'ga_address' => @$row[3], 
            'ga_event_begins' => @$row[5],
            'ga_event_ends' => @$row[5],
            'ga_description' => @$row[6],
            'ga_team' => @$row[7],
            'name' => @$row[0],
            'phone_no' => @$row[13],
            'status' => @$row[8], 
            'receipt_number' => @$row[9],
            'invoice_number' => @$row[10],
            'price' => (int)@$row[11],
            'service_type' => @$row[12],
            ]);

    }

    public function rules(): array
    {
        return [
            '5' =>  Carbon::createFromFormat('Y-m-d'),
        ];
    }

    public function startRow() :int
    {
        return 2;
   }
}
