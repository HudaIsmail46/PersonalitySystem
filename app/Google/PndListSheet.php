<?php

namespace App\Google;
use App\Order;
use Sheets;
use Carbon\Carbon;

class PndListSheet
{   
    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
                $this->order->customer ? $this->order->customer->name : '',//name
                $this->order->fullAddress(),// alamat
                $this->order->customer ? $this->order->customer->phone_no : '',// no telefon 1
                '',// no telefon 2
                '',// email
                $this->order->created_at->toDateString(),// tarikh
                $this->order->created_at->format('H:m'),// start time
                $this->order->created_at->format('H:m'),// end time
                '',// job description
                '',// addition
                $this->order->deductions(),// deduction
                $this->order->deposit_paid_at ? 'paid' : '',// deposit status
                $this->order->deposit_paid_at ? $this->order->deposit_amount / 100 : '',// deposit value
                0,// actual cku residential
                0,// actual cku commercial
                0,// actual mcs residential
                0,// actual mcs commercial
                0,// actual hq
                $this->order->totalPrice() / 100,// estimated p&d
                $this->order->creator ? $this->order->creator->name : '',// handled by
                '',// ecom
                implode("\n", $this->order->productList()),// products
                '',// team
                $this->order->paid_at ? 'paid' : 'no record',// payment status
                0,// actual cku residential
                0,// actual cku commercial
                0,// actual mcs residential
                0,// actual mcs commercial
                0,// actual hq
                $this->order->totalPrice() / 100,// actual p&d
                '',// no invois
                'pnd: ' . $this->order->id,// jobId
                humaniseOrderState($this->order->state),// job status
            ]
        ];

        Sheets::spreadsheet($spreadsheetId)->sheet($sheetId)->append($data);
    }
}
