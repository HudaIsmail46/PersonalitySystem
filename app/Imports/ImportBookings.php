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
    * @param array $col
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $col)
    {
        $name = @$col[0];
        $phone_no = @$col[14];
        $date = @$col[5];
        $customer = Customer::findOrCreate($name, $phone_no);
        $existingBooking = Booking::where('customer_id', $customer->id)->whereDate('event_begins', $date)->count();
        logger($existingBooking);
        if($existingBooking > 0){
           return null;
        } else {
            return new Booking([
                'gc_address' => @$col[3],
                'event_begins' => $date,
                'event_ends' => $date,
                'gc_description' => strip_tags(@$col[6]),
                'pic' => @$col[7],
                'name' => $name,
                'phone_no' => $phone_no,
                'status' => @$col[8],
                'receipt_number' => @$col[9],
                'invoice_number' => @$col[10],
                'price' => (int)@$col[11],
                'service_type' => @$col[12],
                'customer_id' => $customer ? $customer->id : null
            ]);
        }
    }

    public function startRow() :int
    {
        return 2;
   }
}
