<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\RunnerSchedule;

class RunnerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $runner_schedules = RunnerSchedule::with(['runnerJobs.order', 'runner'])->orderBy('id', 'ASC')->paginate(50);

        return view('external.runner_schedule.index', compact('runner_schedules'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerSchedule $runner_schedule)
    {
        return view('external.runner_schedule.show', compact('runner_schedule'));
    }
}
