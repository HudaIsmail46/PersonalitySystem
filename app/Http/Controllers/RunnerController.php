<?php

namespace App\Http\Controllers;

use App\RunnerSchedule;

use Carbon\Carbon;

class RunnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth()->user()->id;
        $runner_schedules = RunnerSchedule::orderBy('id', 'ASC')->where('runner_id',$id)->where('status', '!=' ,'draft')->get();
        return view('runner.index',compact('runner_schedules'));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerSchedule $runner_schedule)
    {
        $this->authorizeUser($runner_schedule);
        $runnerJobs = $runner_schedule->runnerJobs()->with('order.customer')->get();
        return view('runner.show', compact('runner_schedule','runnerJobs'));    
    }
    /**
     * Start a runner schedule
     *
     * @return \Illuminate\Http\Response
     */

    public function start(RunnerSchedule $runner_schedule)
    {
        $this->authorizeUser($runner_schedule);
        $runner_schedule->fill([
            'started_at' => Carbon::now(),
            'status' => 'on route',
        ]);
        $runner_schedule->save();
        return redirect()->route('runner.show', compact('runner_schedule'));
    }

    public function authorizeUser(RunnerSchedule $runner_schedule)
    {
        if(Auth()->user()->id != $runner_schedule->runner_id)
            abort('404');
    }
}
