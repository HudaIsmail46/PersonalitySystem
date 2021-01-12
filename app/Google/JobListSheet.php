<?php

namespace App\Google;
use App\Booking;
use Sheets;
use Carbon\Carbon;

class JobListSheet
{   
    protected $booking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function append()
    {
        $spreadsheetId = env('SPREADSHEET_ID');
        $sheetId = env('SHEET_ID');
        $data = [
            [
                $this->booking->customer ? $this->booking->customer->name : '',//name
                $this->booking->fullAddress(),// alamat
                $this->booking->customer->phone_no,// no telefon 1
                '',// no telefon 2
                '',// email
                $this->booking->event_begins->toDateString(),// tarikh
                $this->booking->event_begins->format('H:m'),// start time
                $this->booking->event_ends->format('H:m'),// end time
                $this->booking->remarks ? $this->booking->remarks : '',// job description
                implode("\n", $this->booking->additions()),// addition
                implode("\n", $this->booking->deductions()),// deduction
                $this->booking->deposit() ? 'paid' : '',// deposit status
                $this->booking->deposit() ? $this->booking->deposit() : '',// deposit value
                $this->booking->estimatedCkuResidentialPrice(),// actual cku residential
                $this->booking->estimatedCkuCommercialPrice(),// actual cku commercial
                $this->booking->estimatedMcsResidentialPrice(),// actual mcs residential
                $this->booking->estimatedMcsCommercialPrice(),// actual mcs commercial
                $this->booking->estimatedHqPrice(),// actual hq
                '',// estimated p&d
                $this->booking->handledBy() ? $this->booking->handledBy() : '',// handled by
                '',// ecom
                implode("\n", $this->booking->productList()),// products
                $this->booking->team ? $this->booking->team : '',// team
                $this->booking->aafinance_payment ? 'paid' : 'no record',// payment status
                $this->booking->actualCkuResidentialPrice(),// actual cku residential
                $this->booking->actualCkuCommercialPrice(),// actual cku commercial
                $this->booking->actualMcsResidentialPrice(),// actual mcs residential
                $this->booking->actualMcsCommercialPrice(),// actual mcs commercial
                $this->booking->actualHqPrice(),// actual hq
                '',// actual p&d
                $this->booking->invoice_number ? $this->booking->invoice_number : '',// no invois
                $this->booking->af_reference ? $this->booking->af_reference : '',// jobId
                $this->booking->status ? $this->booking->status : '',// job status
            ]
        ];

        Sheets::spreadsheet($spreadsheetId)->sheet($sheetId)->append($data);
    }
}
