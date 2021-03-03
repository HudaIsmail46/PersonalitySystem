<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DailyReport;
use Carbon\Carbon;
use App\Chart\DailyReportChart;

class DailyReportsController extends AuthenticatedController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->month){
            $month = Carbon::parse($request->month);
            $from_date = $month;
            $to_date =  Carbon::parse($request->month)->lastOfMonth();
        } else {
            $month = Carbon::now();
            $from_date = $month->firstOfMonth();
            $to_date = Carbon::now();
        }

        $daily_reports = DailyReport::whereMonth('date', $month)->orderBy('date', 'ASC')->get();
        $actual_total_sales = 0;
        $estimates_total_sales = 0;
        $rest_of_month_sales = 0;
        $estimates_total_prod = [];
        $actual_total_prod = [];
        $estimates_ch_prod = [];
        $actual_ch_prod = [];
        $estimates_robin_prod = [];
        $actual_robin_prod = [];

        foreach($daily_reports as $daily_report)
        {
            if ($daily_report->date > Carbon::now()) {
                $rest_of_month_sales += $daily_report->estimates_total_sales();
            }
        }

        $daily_report_up_to_today = DailyReport::whereBetween('date', [$from_date->format('Y-m-d'), $to_date->format('Y-m-d')])->get();
        foreach($daily_report_up_to_today as $daily_report)
        {
            $actual_total_sales += $daily_report->actual_total_sales();
            $estimates_total_sales += $daily_report->estimates_total_sales();
            array_push($estimates_total_prod, $daily_report->quotation_total_prods());
            array_push($actual_total_prod, $daily_report->invoice_total_prods());
            array_push($estimates_ch_prod, $daily_report->quotation_ch_prods);
            array_push($actual_ch_prod, $daily_report->invoice_ch_prods);
            array_push($estimates_robin_prod, $daily_report->quotation_robin_prods);
            array_push($actual_robin_prod, $daily_report->invoice_robin_prods);
        }

        return view('daily_report.index', [
            'daily_reports' => $daily_reports,
            'actual_total_sales' => $actual_total_sales,
            'estimates_total_sales' => $estimates_total_sales,
            'estimates_total_prod' => array_sum($estimates_total_prod)/count($estimates_total_prod),
            'actual_total_prod' => array_sum($actual_total_prod)/count($actual_total_prod),
            'estimates_ch_prod' => array_sum($estimates_ch_prod)/count($estimates_ch_prod),
            'actual_ch_prod' => array_sum($actual_ch_prod)/count($actual_ch_prod),
            'estimates_robin_prod' => array_sum($estimates_robin_prod)/count($estimates_robin_prod),
            'actual_robin_prod' => array_sum($actual_robin_prod)/count($actual_robin_prod),
            'to' => $to_date,
            'from' => $from_date,
            'month' => $month,
            'expected_total_sales' => $actual_total_sales + $rest_of_month_sales,
            'daily_report_chart' => DailyReportChart::config($daily_reports)
        ]);
    }

    public function show(DailyReport $daily_report)
    {
        return view('daily_report.show', compact('daily_report'));
    }

    public function edit(DailyReport $daily_report)
    {
        return view('daily_report.edit', compact('daily_report'));
    }

    public function update(DailyReport $daily_report)
    {
        $daily_report->update($this->validateUpdateDailyReport());
        $daily_report->calculateProductivity();

        return redirect()->route('daily_report.show', $daily_report->id)->with('Booking updated successfully.');
    }

    public function edit_params()
    {
        return view('daily_report.edit_params');
    }

    public function update_params(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'x_factor' => 'required|numeric',
            'y_factor' => 'required|numeric',
            'ch_count' => 'required|numeric',
            'robin_count' => 'required|numeric'
        ]);

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $x_factor = $request->x_factor;
        $y_factor = $request->y_factor;
        $ch_count = $request->ch_count;
        $robin_count = $request->robin_count;

        $dailyReports = DailyReport::whereDate('date', '>=', $from_date)
            ->whereDate('date', '<=', $to_date)
            ->get();

        foreach($dailyReports as $daily_report)
        {
            $daily_report->update([
                'x_factor' => $x_factor,
                'y_factor' => $y_factor,
                'ch_count' => $ch_count,
                'robin_count' => $robin_count,
            ]);
            $daily_report->calculateProductivity();
        }

        return redirect()->route('daily_report.index')->with('Booking updated successfully.');
    }

    protected function validateUpdateDailyReport()
    {
        return request()->validate([
            'x_factor' => 'required|numeric',
            'y_factor' => 'required|numeric',
            'ch_count' => 'required|numeric',
            'robin_count' => 'required|numeric'
        ]);
    }

}
