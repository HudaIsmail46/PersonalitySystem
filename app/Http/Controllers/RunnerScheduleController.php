<?php

namespace App\Http\Controllers;

use App\User;
use App\RunnerSchedule;
use Illuminate\Http\Request;
use App\Order;
use App\State\Order\PendingPickupSchedule;
use App\State\Order\PendingReturnSchedule;

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

        return view('runner_schedule.index', compact('runner_schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RunnerSchedule $runner_schedule)
    {
        $runners  = User::role('Runner')->get();

        return view('runner_schedule.create', compact('runner_schedule', 'runners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData();
        $runner_schedule = new RunnerSchedule;
        $runner_schedule->fill([
            'runner_id' => $request->runner_id,
            'scheduled_at' => $request->scheduled_at,
            'status' => $request->status
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
        $runnerJobs = $runner_schedule->runnerJobs()->orderBy('scheduled_at')->get();
        return view('runner_schedule.show', compact('runner_schedule', 'runnerJobs'));
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
        $orders = Order::whereState('state', [PendingPickupSchedule::class, PendingReturnSchedule::class])->with('customer')->get();
        $runnerJobs = $runner_schedule->runnerJobs()->with('order.customer')->get();

        return view('runner_schedule.edit', compact('runner_schedule', 'runners', 'orders', 'runnerJobs'));
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

        return redirect()->route('runner_schedule.index', compact('runner_schedule'));
    }

    protected function validateData()
    {
        return request()->validate([
            'runner_id' => 'required',
            'scheduled_at' => 'required',
            'status' => 'required',
        ]);
    }
}
