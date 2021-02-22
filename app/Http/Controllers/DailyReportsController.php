<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DailyReport;

class DailyReportsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $daily_reports = DailyReport::orderBy('date', 'ASC')->paginate(20);

        return view('daily_report.index', ['daily_reports' => $daily_reports])
            ->with('i', ($daily_reports->get('page', 1) - 1) * 50);
    }

}
