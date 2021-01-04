<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderItem;
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
        $order->fill([
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'address_3' => $request->address_3,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'location_state' => $request->location_state,
            'quantity' => $request->quantity,
            'paid_at' => $request->paid_at,
            'payment_method' => $request->payment_method,
            'prefered_pickup_datetime' => $request->prefered_pickup_datetime,
            'deposit_payment_method' => $request->deposit_payment_method,
            'deposit_paid_at' => $request->deposit_paid_at,
            'deposit_amount' => priceCents($request->deposit_amount),
            'discount_type' => $request->discount_type,
            'discount_rate' => $request->discount_rate,
            'notice_ambilan_ref' => $request->notice_ambilan_ref,
            'walk_in_customer' => isset($request->walk_in_customer),
            'state' => $request->state,
            'collected_at' => $request->collected_at,
            'arrived_warehouse_at' => $request->arrived_warehouse_at,
            'vendor_collected_at' => $request->vendor_collected_at,
            'vendor_returned_at' => $request->vendor_returned_at,
            'leave_warehouse_at' => $request->leave_warehouse_at,
            'returned_at' => $request->returned_at
        ]);

        $order->save();

        for ($i = 0; $i < count((array)$request->material); $i++) {
            if ($request->item_id != null  && array_key_exists($i, $request->item_id)) {
                OrderItem::find($request->item_id[$i])
                    ->update([
                        'material' => $request->material[$i],
                        'size' => $request->size[$i],
                        'quantity' => $request->quantity_item[$i],
                        'price' =>  priceCents($request->price_item[$i])
                    ]);
                    
            } else {
                if ($request->material[$i] != null) {
                    $order_item = new OrderItem;
                    $data[] = [
                        'order_id' => $order->id,
                        'size' => $request->size[$i],
                        'material' => $request->material[$i],
                        'quantity' => $request->quantity_item[$i],
                        'price' =>  priceCents($request->price_item[$i]),
                        'created_at' => $order_item->freshTimestamp(),
                        'updated_at' => $order_item->freshTimestamp()
                    ];
                    $order_item->insert($data);
                }
            }
        }

        if ($request->delete) {
            for ($i = 0; $i < count($request->delete); $i++) {
                OrderItem::where('id', $request->delete[$i])->delete();
            }
        }

        $total_quantity = OrderItem::where('order_id', $order->id)->sum('quantity');
        $total_price = OrderItem::where('order_id', $order->id)->sum('price');

        $order->update(['quantity' => $total_quantity, 'price' => $total_price]);

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
}