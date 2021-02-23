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

}
