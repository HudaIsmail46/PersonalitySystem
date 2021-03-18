<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    protected $fillable = ['date', 'y_factor', 'x_factor', 'invoice_ch_total_cku',
        'invoice_ch_total_mcs', 'invoice_robin_total_cku', 'invoice_robin_total_mcs',
        'quotation_ch_total_cku', 'quotation_ch_total_mcs', 'quotation_robin_total_cku',
        'quotation_robin_total_mcs', 'jobs', 'ch_count', 'robin_count',
        'quotation_ch_prods', 'invoice_ch_prods','quotation_robin_prods', 'invoice_robin_prods'];

    protected $dates = ['date'];
    protected $casts = ['jobs' => 'array'];

    const SST = 1.06;
    const CHCOUNT = 9;
    const YFACTOR = 3.5;

    public function calculateProductivity()
    {
        $invoice_ch_prods =  ($this->invoice_ch_total_cku + ($this->invoice_ch_total_mcs/2))/$this->ch_count;
        $quotation_ch_prods = ($this->quotation_ch_total_cku + ($this->quotation_ch_total_mcs/2))/$this->ch_count;
        $invoice_robin_prods= ($this->invoice_robin_total_cku + ($this->invoice_robin_total_mcs/2))/$this->y_factor;
        $quotation_robin_prods = ($this->quotation_robin_total_cku + ($this->quotation_robin_total_mcs/2))/$this->y_factor;

        $this->fill([
            'invoice_ch_prods' => (int)$invoice_ch_prods,
            'quotation_ch_prods' => (int)$quotation_ch_prods,
            'invoice_robin_prods' => (int)$invoice_robin_prods,
            'quotation_robin_prods' => (int)$quotation_robin_prods,
        ]);

        $this->save();
    }

    public function actual_total_sales()
    {
        return $this->actual_ch_sales() + $this->actual_robin_sales();
    }

    public function actual_ch_sales()
    {
        return $this->invoice_ch_total_cku + $this->invoice_ch_total_mcs;
    }

    public function actual_robin_sales()
    {
        return $this->invoice_robin_total_cku + $this->invoice_robin_total_mcs;
    }

    public function estimates_total_sales()
    {
        return $this->estimates_ch_sales() + $this->estimates_robin_sales();
    }

    public function estimates_ch_sales()
    {
        return $this->quotation_ch_total_cku + $this->quotation_ch_total_mcs;
    }

    public function estimates_robin_sales()
    {
        return $this->quotation_robin_total_cku + $this->invoice_robin_total_mcs;
    }

    public function quotation_total_prods()
    {
        return ($this->quotation_robin_prods + $this->quotation_ch_prods)/2;
    }

    public function invoice_total_prods()
    {
        return ($this->invoice_robin_prods + $this->invoice_ch_prods)/2;
    }

}
