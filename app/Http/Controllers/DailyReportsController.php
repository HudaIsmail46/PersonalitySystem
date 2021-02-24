<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DailyReport;
use Carbon\Carbon;

class DailyReportsController extends Controller
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
        } else {
            $month = Carbon::now();
        }

        $daily_reports = DailyReport::whereMonth('date', $month)->orderBy('date', 'ASC')->get();

        return view('daily_report.index', ['daily_reports' => $daily_reports]);
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
