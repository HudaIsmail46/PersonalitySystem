<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Customer;
use App\Http\Controllers\AuthenticatedController;

use Illuminate\Http\Request;


class OrderController extends AuthenticatedController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $customers = Customer::select('id', 'name', 'phone_no')->get();
        $customer_options = [];
        $selected_customer = [];
        foreach($customers as $customer){
            $option = ['value'=> $customer->id, 'label'=> $customer->name . ", " . $customer->phone_no];
            if($order->customer_id == $customer->id){
               $selected_customer = $option;
            }
            array_push($customer_options, $option);
        }

        return view('admin.order.edit', compact('order', 'customer_options', 'selected_customer'));
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
        $this->validateUpdateOrders();
        $order->fill($request->all());

        $order->save();

        return redirect()->route('order.show', $order)->with('Order is Updated.');
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

    protected function validateUpdateOrders()
    {
        return request()->validate([
            'size' => 'required',
            'price' => 'required',
            'prefered_pickup_datetime' => 'required',
            'address_1' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'location_state' => 'required'
        ]);
    }
}