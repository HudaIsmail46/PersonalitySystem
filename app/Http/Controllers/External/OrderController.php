<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\AuthenticatedController;
use App\Order;

class OrderController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('customer', 'comments')
            ->orderBy('id', 'ASC')
            ->where('state', '=', 'App\State\Order\VendorCollected')
            ->paginate(10);
        return view('external.order.index', compact('orders'))
            ->with('i', ($orders->get('page', 1) - 1) * 5);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $runnerJobImages = [];
        $runnerJobs = $order->runnerJobs()->get();
        if ($runnerJobs != null) {
            foreach ($runnerJobs as $runnerJob) {
                $runnerJobImages = $runnerJob->images;
            }
        }
        return view('external.order.show', compact('order', 'runnerJobImages'));
    }
}
