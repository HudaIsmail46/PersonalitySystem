<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chart\IncompleteBooking;
use App\Chart\MonthlyBooking;

class HomeController extends AuthenticatedController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $incompleteBookingChart = IncompleteBooking::config();
        $monthlyBookingChart = MonthlyBooking::config();

        return view('home', compact('incompleteBookingChart', 'monthlyBookingChart'));
    }
}
