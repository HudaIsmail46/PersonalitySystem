<?php

namespace App\Http\Controllers;

use App\RunnerJob;
use App\Order;
use App\Image;
use App\State\Order\Returned;
use App\State\Order\PendingPickupSchedule;
use App\State\Order\PendingReturnSchedule;
use App\State\Order\PickupScheduled;
use App\State\Order\ReturnScheduled;
use App\State\Order\Collected;
use App\State\Order\ReceivedWarehouse;
use App\State\Order\VendorCollected;
use App\State\Order\InHouseCleaning;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        if ($order->state == PendingPickupSchedule::class) {
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
        $runnerJobs = $runnerJob->runnerSchedule->runnerJobs->load('order.customer');
        $orders = Order::whereState('state', [PendingPickupSchedule::class, PendingReturnSchedule::class])->with('customer')->get();

        return json_encode(['runnerJobs'=>$runnerJobs, 'orders'=>$orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function show(RunnerJob $runnerJob )
    {
        return view('runner_job.show', compact('runnerJob'));
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
        $runnerJob->fill([
            'scheduled_at' => $request->scheduled_at
        ]);
        $runnerJob->save();
        $runnerJobs = $runnerJob->runnerSchedule->runnerJobs->load('order.customer');
        $runnerJobs;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RunnerJob  $runnerJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(RunnerJob $runnerJob)
    {
        $runnerSchedule = $runnerJob->runnerSchedule;
        $order = $runnerJob->order;

        if ($order->state == PickupScheduled::class) {
            $transitionTo = PendingPickupSchedule::class;
        } else {
            $transitionTo = PendingReturnSchedule::class;
        }

        $order->update([
            'state' => $transitionTo
        ]);

        $runnerJob->delete();
        $runnerJobs = $runnerSchedule->runnerJobs->load('order.customer');
        $orders = Order::whereState('state', [PendingPickupSchedule::class, PendingReturnSchedule::class])->with('customer')->get();
        return json_encode(['runnerJobs'=>$runnerJobs, 'orders'=>$orders]);
    }

    public function status(RunnerJob $runnerJob)
    {
        $order = $runnerJob->order;
        $runnerSchedule = $runnerJob->runnerSchedule;

        switch($order->state){
        case PickupScheduled::class:
            $transitionTo = Collected::class;
            break;
        case ReturnScheduled::class:
            $transitionTo = Returned::class;
            break;
        case Collected::class:
            $transitionTo = ReceivedWarehouse::class;
            break;
        case ReceivedWarehouse::class:
            $transitionTo = VendorCollected::class;
            break;
        case ReceivedWarehouse::class:
            $transitionTo = InHouseCleaning::class;
            break;
        default:
            break;
        }
        
        $order->update([
            'state' => $transitionTo
        ]);
        
        $runnerJobs = $runnerSchedule->runnerJobs->load('order.customer');
        $orders = Order::whereState('state',[PendingPickupSchedule::class, PendingReturnSchedule::class,Collected::class,ReceivedWarehouse::class,VendorCollected::class,InHouseCleaning::class])->with('customer')->get();
        return json_encode(['runnerJobs'=>$runnerJobs, 'orders'=>$orders]);
    }


    public function complete(RunnerJob $runnerJob)
    {
        $runnerJob = $runnerJob->find($runnerJob->id);
        $runnerJob->fill([
            'completed_at' => Carbon::now(),
        ]);
        $runnerJob->save();

        if(request()->hasFile('image')){
            $this->validateImage();
            $image = new Image;
            $this->storeImage($image, $runnerJob->id);
            $image->save();
        }
        return redirect()->route('runner_job.show',$runnerJob);
    }

    protected function validates()
    {
        return request()->validate([
            'runner_schedule_id' => 'required',
            'order_id' => 'required',
            'scheduled_at' => 'required'
        ]);
    }

    public function validateImage()
    {
        return request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    public function storeImage($image, $id)
    { 
        $image->fill([
            'imageable_id'=>$id,
            'imageable_type' =>RunnerJob::class,
            'file'=>request()->image->store('uploads','public'),
        ]);
    }

    public function destroyImage(Image $image)
    {
        $runnerJob = $image->imageable->id;
        $image->delete();

        return redirect()->route('runner_job.show', $runnerJob)->with('Image has been Updated.');
    }

}
