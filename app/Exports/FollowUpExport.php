<?php

namespace App\Exports;

use App\FollowUp;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FollowUpExport implements FromQuery, WithHeadings, WithMapping
{

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function query()
    {
        return FollowUp::query()->with('booking.invoice', 'customer');
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'Customer Phone Number',
            'Booking Date Time',
            'Booking Value',
            'lead_status',
            'follow_up_status',
            'sales_person',
            'voucher_percent',
            'expire_at'
        ];
    }

    public function map($followUp): array
    {
        if ($followUp->booking && $followUp->customer) {
            return [
                $followUp->customer->name,
                $followUp->customer->phone_no,
                $followUp->booking->event_begins,
                money($followUp->booking->price),
                $followUp->lead_status,
                $followUp->follow_up_status,
                $followUp->sales_person,
                $followUp->voucher_percent,
                $followUp->expire_at,
            ];
        } else {
            return [];
        }

    }
}
