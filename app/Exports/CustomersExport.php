<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Customer;

class CustomersExport implements FromQuery, WithHeadings, WithMapping
{
    public function __construct($params)
    {
        $this->params = $params;
    }

    public function query()
    {
        if ($this->params == '') {
            $customers = Customer::query()->with('bookings', 'orders');
        } else {
            parse_str($this->params, $output);

            $name = $output['name'];
            $phone_no  = $output['phone_no'];
            $address = $output['address'];

            $customers = Customer::query()
                ->with('bookings', 'orders')
                ->when($name, function ($q) use ($name) {
                    return $q->where('name', 'ILIKE', '%' . $name . '%');
                })
                ->when($address, function ($q) use ($address) {
                    return $q->where('address_1', 'ILIKE', '%' . $address . '%')
                        ->orWhere('address_2', 'ILIKE', '%' . $address . '%')
                        ->orWhere('address_3', 'ILIKE', '%' . $address . '%');
                })
                ->when($phone_no, function ($q) use ($phone_no) {
                    return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
                })
                ->orderBy('id', 'ASC');
        }

        return $customers;
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Phone No',
            'Address 1',
            'Address 2',
            'Address 3',
            'Postcode',
            'City',
            'State',
            'Full Address(legacy)',
            'Total Bookings',
            'Booking LTV',
            'Latest Booking',
            'Total Pnd',
            'Pnd LTV',
            'Latest Pnd'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->phone_no ,
            $customer->address_1,
            $customer->address_2,
            $customer->address_3,
            $customer->postcode,
            $customer->city,
            $customer->location_state,
            $this->customerAddress($customer),
            count($customer->bookings),
            "MYR ".number_format($customer->bookings->sum('price')/100, 2),
            $customer->bookings->max('event_begins'),
            count($customer->orders),
            "MYR ".number_format($customer->orders->sum('price')/100, 2),
            $customer->orders->max('created_at'),
        ];
    }

    public function customerAddress($customer){
        if (!is_null($customer->address_1) || !is_null($customer->address_2) || !is_null($customer->address_3) || !is_null($customer->postcode) || !is_null($customer->city) || !is_null($customer->location_state)) {
            $address = '';
        } else {
            $booking = $customer->bookings->first();
            if ($booking) {
                $address = $booking->gc_address;
            } else {
                $address = '-';
            }
        }

        return $address;
    }

    public function latestBooking($collection){
        $booking = $collection->orderBy('id', 'desc')->first();
        if ($booking) {
            return $booking->event_begins;
        }
    }

    public function latestOrder($collection){
        $order = $collection->orderBy('id', 'desc')->first();
        if ($order) {
            return $order->created_at;
        }
    }


}
