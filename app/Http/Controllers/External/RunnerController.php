<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\AuthenticatedController;
use App\RunnerSchedule;
use Carbon\Carbon;

class RunnerController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth()->user()->id;
        $today = Carbon::today()->toDateTimeString();
        $runner_schedules = RunnerSchedule::with(['runnerJobs.order', 'runner'])->where('runner_id',$id)->where('scheduled_at', '>=' , $today)->orderBy('id', 'ASC')->where('status', '!=' ,'draft')->get();
        $previous_runner_schedules = RunnerSchedule::with(['runnerJobs.order', 'runner'])->where('runner_id',$id)->where('scheduled_at', '<' , $today)->orderBy('id', 'ASC')->where('status', '!=' ,'draft')->get();

        return view('external.runner.index', compact('runner_schedules', 'previous_runner_schedules'));
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
        $runnerJobs = $runner_schedule->runnerJobs()->orderBy('scheduled_at')->with('order.customer')->get();
        return view('external.runner.show', compact('runner_schedule','runnerJobs'));    
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
        return redirect()->route('external.runner.show', compact('runner_schedule'));
    }

    public function authorizeUser(RunnerSchedule $runner_schedule)
    {
        if(Auth()->user()->id != $runner_schedule->runner_id)
            abort('404');
    }
}
