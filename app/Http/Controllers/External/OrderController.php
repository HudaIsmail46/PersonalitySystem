<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('customer')
        ->orderBy('id', 'ASC')
        ->where('state', '=' ,'App\State\Order\VendorCollected')
        ->paginate(50);
    return view('external.order.index', compact('orders'))
        ->with('i', ($orders->get('page', 1) - 1) * 50);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('external.order.show', compact('order'));
    }
}
