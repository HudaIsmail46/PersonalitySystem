<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection , WithHeadings , WithMapping
{
    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function collection()
    {
        return $this->customers;
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Phone No',
            'Address',
            'Total Bookings',
            'Total Pnd',
            'Booking LTV',
            'Pnd LTV',
            'Latest Booking',
            'Latest Pnd'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->phone_no ,
            $this->customerAddress($customer),
            $customer->bookings()->count(),
            money($customer->bookings()->sum('price')),
            $customer->orders()->count(),
            money($customer->orders()->sum('price')),
            $this->latestBooking($customer->bookings()),
            $this->latestOrder($customer->orders()),
        ];
    }

    public function customerAddress($customer){
        if (!is_null($customer->address_1) || !is_null($customer->address_2) || !is_null($customer->address_3) || !is_null($customer->postcode) || !is_null($customer->city) || !is_null($customer->location_state)) {
            $address = $customer->fullAddress();
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
