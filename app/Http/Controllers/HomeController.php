<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chart\StudentPerformance;
use App\Chart\DimensionScores;

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
        $studentPerformanceChart = StudentPerformance::config();
        $dimensionScoresChart = DimensionScores::config();   
        return view('home', compact('studentPerformanceChart','dimensionScoresChart'));
    }
}
