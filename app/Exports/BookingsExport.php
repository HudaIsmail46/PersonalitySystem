<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection , WithHeadings, WithMapping
{
    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    public function collection()
    {
        return $this->bookings;
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Phone No',
            'Address',
            'Event Begins',
            'Event Ends',
            'Team'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->customer->name ?? '',
            $booking->customer ? (String)$booking->customer->phone_no : '',
            $booking->gc_address,
            $booking->gc_event_begins ??  $booking->event_begins,
            $booking->gc_event_ends ?? $booking->event_ends,
            $booking->gc_team ?? $booking->team ,
        ];
    }
}
