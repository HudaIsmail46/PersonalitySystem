<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
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
            'Team',
            'Booking Status',
            'Invoice No'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->customer->name ?? '',
            $booking->customer ? (string)$booking->customer->phone_no : '',
            $booking->gc_address ?? $booking->fullAddress(),
            $booking->event_begins,
            $booking->event_ends,
            $this->displayAgents($booking),
            $booking->status,
            $booking->invoice_number
        ];
    }

    public function displayAgents($booking)
    {

        if ($booking->team == "" && $booking->status != "Unassigned") {
            if (count($booking->teams()) == 0) {
                $agents = "Unassigned";
            } else {
                $agents = implode("\n", $booking->teams());
            }
        } elseif ($booking->status == "Unassigned") {
            $agents = "Unassigned";
        } else {
            $agents = $booking->team;
        }


        return $agents;
    }
}
