<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\AuthenticatedController;
use App\RunnerJob;
use App\Order;
use App\State\Order\Returned;
use App\State\Order\PendingPickupSchedule;
use App\State\Order\PendingReturnSchedule;
use App\State\Order\PickupScheduled;
use App\State\Order\InDelivery;
use App\State\Order\Collected;
use App\State\Order\Completed;
use App\State\Order\ReceivedWarehouse;
use App\State\Order\VendorCollected;
use App\State\Order\InHouseCleaning;
use App\State\Order\Scheduled;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RunnerJobController extends AuthenticatedController
{
    /**
     * Display the specified resource.
     *
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerJob $runnerJob)
    {
        return view('external.runner_job.show', compact('runnerJob'));
    }

    public function complete(RunnerJob $runnerJob)
    {
        $runnerJob->fill([
            'completed_at' => Carbon::now(),
        ]);
        $runnerJob->save();

        $order = $runnerJob->order;
        if ($order->state == PickupScheduled::class) {
            $transitionTo = Collected::class;
        } else if ($order->state == InDelivery::class) {
            $transitionTo = Returned::class;
        }

        $order->state->transitionTo($transitionTo);

        $runnerJob->update([
            'state' => 'completed',
        ]);

        return redirect()->route('external.runner_job.show', $runnerJob);
    }

    public function abort(RunnerJob $runnerJob)
    {
        $runnerJob->update([
            'state' => 'canceled',
        ]);

        $order = $runnerJob->order;

        if ($order->state == PickupScheduled::class) {
            $transitionTo = PendingPickupSchedule::class;
        } else {
            $transitionTo = PendingReturnSchedule::class;
        }

        $order->state->transitionTo($transitionTo);

        return redirect()->route('external.runner_job.show', $runnerJob);
    }
}
