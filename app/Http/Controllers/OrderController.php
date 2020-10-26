<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'ASC')->paginate(50);
        return view('order.index', ['orders' => $orders])
            ->with('i', ($orders->get('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->storeOrders();
            Order::create($request->all());
            return redirect()->route('order.index')->with('Order is created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($this->validateOrders());

        return redirect()->route('order.index')->with('Order is Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('order.index')->with('Order succesfully deleted.');
    }

    protected function storeOrders()
    {
        return request()->validate([
            'size' => 'required',
            'material' => 'required',
            'price' => 'required',
            'prefered_pickup_datetime' => 'required',
        ]);
    }

    protected function validateOrders()
    {
        return request()->validate([
            'size' => 'required',
            'material' => 'required',
            'price' => 'required',
            'prefered_pickup_datetime' => 'required',
            'actual_length' => 'required',
            'actual_width' => 'required',
            'actual_material' => 'required',
            'actual_price' => 'required',
            'status' => 'required',
        ]);
    }


}
