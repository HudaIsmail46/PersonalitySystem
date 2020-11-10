<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use App\Image;
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
        $this->validateCreateOrders();

        $customer = Customer::firstOrCreate($request->customer_name, $request->customer_phone_no);
        $order = new Order;
        $order->fill([
            'customer_id' => $customer->id,
            'size' => $request->size,
            'material' => $request->material,
            'price' => $this->priceCents($request->price),
            'prefered_pickup_datetime' => $request->prefered_pickup_datetime,
        ]);
        $order->save();

        $image = new Image;
        $this->storeImage($image, $order);
        $image->save();

        return redirect()->route('order.show',$order->id)->with('Order is created.');
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
        $this->validateUpdateOrders();

        $order->fill([
            'actual_size' => $request->actual_size,
            'actual_material' => $request->actual_material,
            'actual_price' => $this->priceCents($request->actual_price),
            'size' => $request->size,
            'material' => $request->material,
            'price' => $this->priceCents($request->price),
            'prefered_pickup_datetime' => $request->prefered_pickup_datetime,
            'status' => $request->status
        ]);
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

    protected function priceCents($price)
    {
        return $price ? $price * 100 : 0;
    }

    protected function validateUpdateOrders()
    {
        return request()->validate([
            'size' => 'required',
            'material' => 'required',
            'price' => 'required',
            'prefered_pickup_datetime' => 'required',
            'status' => 'required',
        ]);
    }

    protected function validateCreateOrders()
    {
        $validateData =request()->validate([
            'customer_name' => 'required',
            'customer_phone_no' => 'required',
            'size' => 'required',
            'material' => 'required',
            'price' => 'required',
            'prefered_pickup_datetime' => 'required',
            'status' => 'required',
        ]);

        if(request()->hasFile('image'))
        {
            request()->validate([
                'image' => 'file|image',
            ]);
        }
        return $validateData;
    }

    public function storeImage( $image, $order)
    {
        if(request()->has('image'))
        {
            $image->fill([
                'imageable_id'=>$order->id,
                'imageable_type' =>Order::class,
                'file'=>request()->image->store('uploads','public'),
            ]);
        }
    }
}


