<?php

namespace App\Exports;

use App\RunnerJob;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RunnerJobExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct($runnerJobs)
    {
        $this->runnerJobs = $runnerJobs;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->runnerJobs;
    }

    public function headings(): array
    {
        return [
            'Runner Job Id',
            'Order Id',
            'Name',
            'Phone No',
            'Address',
            'Scheduled At',
            'Completed At',
            'Runner',
            'Status',
            'Job Type',
            'Price',
            'Items',
            'Quantity'
        ];
    }

    public function map($runnerJob): array
    {
        if ($runnerJob->order && $runnerJob->order->customer && $runnerJob->runnerSchedule && $runnerJob->runnerSchedule->runner) {
            return [
                $runnerJob->id,
                $runnerJob->order_id,
                $runnerJob->order->customer->name,
                (String)$runnerJob->order->customer->phone_no,
                $runnerJob->order->fullAddress(),
                $runnerJob->scheduled_at,
                $runnerJob->completed_at,
                $runnerJob->runnerSchedule->runner->name,
                $runnerJob->state,
                $runnerJob->job_type,
                money($runnerJob->order->totalPrice()),
                implode(', ', $runnerJob->order->productList()),
                $runnerJob->order->orderItems->sum('quantity')
            ];
        } else {
            return [];
        }
    }
}
