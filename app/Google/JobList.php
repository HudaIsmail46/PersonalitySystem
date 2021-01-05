<?php

namespace App\Google;
use Sheets;
use App\Booking;

class JobList
{
    public function append(Booking $booking)
    {
        $spreadsheetId = '1GLBz_fqAFZGmkZHyRHMPcE-u3ZSV9xPkUMOVks4M4M4';
        $sheetId = 'Sheet1';
        $dataRow = [
            [
                $booking->customer->name,//name
                $booking->fullAddress(),// alamat
                $booking->customer->phone_no,// no telefon 1
                '',// no telefon 2
                '',// email
                $booking->event_begins,// tarikh
                $booking->event_begins,// start time
                $booking->event_ends,// end time
                $booking->remarks,// job description
                $this->discount(),// discount
                $this->deposit() ? 'paid' : '',// deposit status
                $this->deposit(),// deposit value
                '',// estimated residential
                '',// estimated commercial
                '',// estimated hq
                '',// estimated p&d
                $booking->handled_by(),// handled by
                '',// ecom
                $this->products(),// products
                $booking->team,// team
                '',// payment status
                '',// actual residential
                '',// actual commercial
                '',// actual hq
                '',// actual p&d
                '',// no invois
                '',// jobId
                ''// job status
            ]
        ];
        Sheets::spreadsheet($spreadsheetId)->sheet($sheetId)->append($dataRow);
    }
} 
