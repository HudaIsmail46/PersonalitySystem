<?php

namespace App\Http\Controllers;

use App\User;
use App\RunnerSchedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\State\Order\PendingPickupSchedule;
use App\State\Order\PendingReturnSchedule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RunnerJobExport;

class RunnerScheduleController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $today = Carbon::today()->toDateTimeString();
        $tomorrow = Carbon::tomorrow()->toDateTimeString();

        $previous_runner_schedules = RunnerSchedule::with(['runnerJobs.order', 'runner'])->whereDate('scheduled_at', '<' , $today)->orderBy('id', 'ASC')->paginate(50);
        $runner_schedules = RunnerSchedule::with(['runnerJobs.order', 'runner'])->whereDate('scheduled_at', $today)->orderBy('id', 'ASC')->paginate(50);
        $future_runner_schedules = RunnerSchedule::with(['runnerJobs.order', 'runner'])->whereDate('scheduled_at' ,'>=', $tomorrow)->orderBy('id', 'ASC')->paginate(50);

        return view('runner_schedule.index', compact('runner_schedules', 'previous_runner_schedules', 'future_runner_schedules'));
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

    public function fileExport(RunnerSchedule $runner_schedule)
    {
        $runnerJobs = $runner_schedule->runnerJobs()->orderBy('scheduled_at')
            ->with('order.customer', 'runnerSchedule.runner')->get();

        return Excel::download(new RunnerJobExport($runnerJobs), 'runnerJob-CleanHero.csv');
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
        $orders = Order::whereState('state', [PendingPickupSchedule::class, PendingReturnSchedule::class])->orderBy('city', 'ASC')->with('customer')->get();
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
            'scheduled_at' => 'required|after_or_equal:today',
            'status' => 'required',
        ]);
    }
}
