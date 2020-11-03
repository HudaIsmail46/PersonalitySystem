<?php

namespace App\Http\Controllers;

use App\User;
use App\RunnerSchedule;
use Illuminate\Http\Request;

class RunnerScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $runner_schedules =RunnerSchedule::orderBy('id','ASC')->paginate(50);

        return view('runner_schedule.index',compact('runner_schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RunnerSchedule $runner_schedule)
    {
        $runners  = User::role('Runner')->get();

        return view('runner_schedule.create',compact('runner_schedule', 'runners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateDates();
        $runner_schedule = new RunnerSchedule;
        $runner_schedule->fill([
            'runner_id' =>$request->runner_id,
            'scheduled_at'=>$request->scheduled_at,
            'expected_at' =>$request->expected_at,
            'status'=>$request->status
        ]);
        $runner_schedule->save();

        return redirect()->route('runner_schedule.show', compact('runner_schedule'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerSchedule $runner_schedule)
    {
        return view('runner_schedule.show',compact('runner_schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RunnerSchedule $runner_schedule)
    {
        $runners  = User::role('Runner')->get();
        return view('runner_schedule.edit', compact('runner_schedule','runners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RunnerSchedule $runner_schedule)
    {
        $runner_schedule->update($request->all());
        return redirect()->route('runner_schedule.index', compact('runner_schedule'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RunnerSchedule $runner_schedule)
    {
        $runner_schedule->delete();

         return redirect()->route('runner_schedule.index',compact('runner_schedule'));
    }

    protected function validateDates()
    {
        return request()->validate([
            'scheduled_at'=>'required',
            'expected_at'=>'required|after:scheduled_at',
            'status' => 'required',
        ]);
    }
}


