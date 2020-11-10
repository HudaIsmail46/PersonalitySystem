<?php

namespace App\Http\Controllers;

use App\RunnerJob;
use App\Order;
use App\State\Order\PendingPickupSchedule;
use App\State\Order\PendingReturnSchedule;
use App\State\Order\PickupScheduled;
use App\State\Order\ReturnScheduled;
use Illuminate\Http\Request;

class RunnerJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validates();
        $order = Order::find($request->order_id);
        $runnerJob = new RunnerJob;

        if ( $order->state == PendingPickupSchedule::class){
            $jobType = 'pickup';
            $transitionTo = PickupScheduled::class;
        } else {
            $jobType = 'delivery';
            $transitionTo = ReturnScheduled::class;
        }

        $runnerJob->fill([
            'runner_schedule_id' => $request->runner_schedule_id,
            'order_id' => $request->order_id,
            'scheduled_at' => $request->scheduled_at,
            'job_type' => $jobType
        ]);
       
        $runnerJob->save();
        $order->transitionTo($transitionTo);
        $runnerJob->load('order.customer');

        return $runnerJob;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerJob $runnerJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function edit(RunnerJob $runnerJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RunnerJob $runnerJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(RunnerJob $runnerJob)
    {
        //
    }

    protected function validates()
    {
        return request()->validate([
            'runner_schedule_id' => 'required',
            'order_id' => 'required',
            'scheduled_at' => 'required'
        ]);
    }
}
