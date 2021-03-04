<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use App\Booking;
use App\DailyReport;

class GenerateDailyReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $date;
    protected $jobs = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($dateString = null)
    {
        if (is_null($dateString)) {
            $this->date = Carbon::today();
        } else {
            $this->date = Carbon::createFromFormat('d/m/Y', $dateString);
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sst = DailyReport::SST;
        $bookings = Booking::whereDate('event_begins', $this->date->toDateString())
            ->whereNotNull('team')
            ->whereIn('status', ['Pending', 'Completed', 'Comfirmed'])
            ->with('customer')
            ->get();

        $dailyReport = DailyReport::whereDate('date', $this->date->toDateString())->first();
        if (!$dailyReport) {
            $dailyReport = new DailyReport;
            $dailyReport->fill([
                'date' => $this->date,
                'y_factor' =>3.5,
                'x_factor' => 14.15,
                'invoice_ch_total_cku' => 0,
                'invoice_ch_total_mcs' => 0,
                'invoice_robin_total_cku' => 0,
                'invoice_robin_total_mcs' => 0,
                'quotation_ch_total_cku' => 0,
                'quotation_ch_total_mcs' => 0,
                'quotation_robin_total_cku' => 0,
                'quotation_robin_total_mcs' => 0,
                'jobs' => [],
                'ch_count' => 8,
                'robin_count' => 5,
                'invoice_ch_prods' => 0,
                'quotation_robin_prods' => 0,
                'invoice_robin_prods' => 0,
                'invoice_robin_prods' => 0,
                'quotation_ch_prods' => 0
            ]);
        }

        foreach($bookings as $booking){
            $job = [];
            if (preg_match("/^robin/i", $booking->team)) {
                $job = [
                    'team' => $booking->team,
                    'team_type' => 'robin',
                    'booking_id' => $booking->id,
                    'customer_name' => $booking->customer->name,
                    'invoice_robin_total_cku' => ($booking->afterDeductionCkuActual() + $booking->actualAdditionsSum())/$sst,
                    'invoice_robin_total_mcs' => $booking->afterDeductionMcsActual()/$sst,
                    'quotation_robin_total_cku' => ($booking->afterDeductionCkuEstimates() + $booking->estimateAdditionsSum())/$sst,
                    'quotation_robin_total_mcs' => $booking->afterDeductionMcsEstimates()/$sst,
                    'invoice_ch_total_cku' => 0,
                    'invoice_ch_total_mcs'  => 0,
                    'quotation_ch_total_cku' => 0,
                    'quotation_ch_total_mcs' => 0
                ];
            } else {
                $job = [
                    'team' => $booking->team,
                    'team_type' => 'ch',
                    'booking_id' => $booking->id,
                    'customer_name' => $booking->customer->name,
                    'invoice_ch_total_cku' => ($booking->afterDeductionCkuActual() + $booking->actualAdditionsSum())/$sst,
                    'invoice_ch_total_mcs' => $booking->afterDeductionMcsActual()/$sst,
                    'quotation_ch_total_cku' => ($booking->afterDeductionCkuEstimates() + $booking->estimateAdditionsSum())/$sst,
                    'quotation_ch_total_mcs' => $booking->afterDeductionMcsEstimates()/$sst,
                    'invoice_robin_total_cku' => 0,
                    'invoice_robin_total_mcs'  => 0,
                    'quotation_robin_total_cku' => 0,
                    'quotation_robin_total_mcs' => 0,
                ];
            }
            array_push($this->jobs, $job);
        }

        $dailyReport->fill([
            'invoice_ch_total_cku' => (int)$this->sumOf('invoice_ch_total_cku'),
            'invoice_ch_total_mcs' => (int)$this->sumOf('invoice_ch_total_mcs'),
            'invoice_robin_total_cku' => (int)$this->sumOf('invoice_robin_total_cku'),
            'invoice_robin_total_mcs' => (int)$this->sumOf('invoice_robin_total_mcs'),
            'quotation_ch_total_cku' => (int)$this->sumOf('quotation_ch_total_cku'),
            'quotation_ch_total_mcs' => (int)$this->sumOf('quotation_ch_total_mcs'),
            'quotation_robin_total_cku' => (int)$this->sumOf('quotation_robin_total_cku'),
            'quotation_robin_total_mcs' => (int)$this->sumOf('quotation_robin_total_mcs'),
            'jobs' => $this->jobs,
        ]);

        $dailyReport->save();
        $dailyReport->calculateProductivity();

        return 0;
    }

    private function sumOf($keyName)
    {
        $sum = 0.0;
        foreach($this->jobs as $job)
        {
            $sum += $job[$keyName];
        }

        return $sum;
    }
}
