<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Support\Facades\Crypt;

class CustomerOrderController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($orderId)
    {
        $id = Crypt::decryptString($orderId);
        $order = Order::find($id);
        return view('external.customer_order.show', compact('order'));
    }
}
