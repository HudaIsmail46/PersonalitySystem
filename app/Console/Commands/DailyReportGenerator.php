<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Booking;
use App\DailyReport;

class DailyReportGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_report:calculate {--date= : Date eg 13/1/2021}';
    protected $jobs = [];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Todays Productivity';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dateString = $this->option('date');
        if (is_null($dateString)) {
            $date = Carbon::today();
        } else {
            $date = Carbon::createFromFormat('d/m/Y', $dateString);
        }
        $sst = DailyReport::SST;
        $bookings = Booking::whereDate('event_begins', $date->toDateString())
            ->whereNotNull('team')
            ->whereIn('status', ['Pending', 'Completed', 'Comfirmed'])
            ->get();

        $dailyReport = DailyReport::whereDate('date', $date->toDateString())->first();
        if (!$dailyReport) {
            $dailyReport = new DailyReport;
            $dailyReport->fill([
                'date' => $date,
                'y_factor' => 2.822,
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
            if (preg_match("/^robin/i", $booking->team)) {
                $job = [
                    'team' => $booking->team,
                    'team_type' => 'robin',
                    'booking_id' => $booking->id,
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
