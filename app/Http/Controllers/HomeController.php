<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chart\IncompleteBooking;
use App\Chart\WeeklyBooking;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $incompleteBookingChart = IncompleteBooking::config();
        $weeklyBookingChart = WeeklyBooking::config();
        // dd($incompleteBookingChart);
        return view('home', compact('incompleteBookingChart', 'weeklyBookingChart'));
    }
}
