<?php

namespace App\Imports;

use App\Booking;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;
use App\Customer;

class ImportBookings implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $name = @$row[0];
        $phone_no = @$row[13];
        $customer = Customer::firstOrCreate($name, $phone_no);
        return new Booking([
            'gc_event_title' => @$row[0],
            'gc_address' => @$row[3],
            'gc_event_begins' =>is_null($row[5]) ? null : Carbon::createFromFormat("yy-m-d", $row[5])->toDateTimeString(),
            'gc_event_ends' =>is_null($row[5]) ? null : Carbon::createFromFormat("yy-m-d", $row[5])->toDateTimeString(),
            'gc_description' => strip_tags(@$row[6]),
            'pic' => @$row[7],
            'name' => $name,
            'phone_no' => $phone_no,
            'status' => @$row[8],
            'receipt_number' => @$row[9],
            'invoice_number' => @$row[10],
            'price' => (int)@$row[19],
            'service_type' => @$row[12],
            'customer_id' => $customer ? $customer->id : null
            ]);
    }

    public function startRow() :int
    {
        return 2;
   }
}
