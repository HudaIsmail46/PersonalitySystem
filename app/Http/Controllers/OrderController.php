<?php

namespace App\Http\Controllers;

use App\Order;
use App\Customer;
use App\Exports\OrdersExport;
use App\OrderItem;
use App\State\Order\Draft;
use App\State\Order\PendingPickupSchedule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends AuthenticatedController
{
    public function fileExport()
    {
        $parsedUrl = parse_url(URL::previous());
        $query = $parsedUrl['query'] ?? '';

        if ($query == '') {
            $orders = Order::all();
        } else {
            parse_str($query, $output);

            $state    = $output['state'];
            $start = $output['from'];
            $end  = $output['to'];
            $name   = $output['name'];
            $id     = $output['id'];
            $phone_no    = $output['phone_no'];
            $notice_ambilan_ref = $output['notice_ambilan_ref'];

            $orders = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
                ->with('customer', 'creator' , 'orderItems' )
                ->select('orders.*', 'customers.name', 'customers.phone_no')
                ->when($state, function ($q) use ($state) {
                    return $q->where('state', $state);
                })
                ->when($id, function ($q) use ($id) {
                    return $q->where('orders.id', $id);
                })
                ->when($start, function ($q) use ($start, $end) {
                    return $q->whereBetween('prefered_pickup_datetime', [$start, $end]);
                })
                ->when($name, function ($q) use ($name) {
                    return $q->where('customers.name', 'ILIKE', '%' . $name . '%');
                })
                ->when($phone_no, function ($q) use ($phone_no) {
                    return $q->where('customers.phone_no', 'LIKE', '%' . $phone_no . '%');
                })
                ->when($notice_ambilan_ref, function ($q) use ($notice_ambilan_ref) {
                    return $q->where('orders.notice_ambilan_ref', 'ILIKE', '%' . $notice_ambilan_ref . '%');
                })
                ->orderBy('id', 'ASC')->get();
        }
        return Excel::download(new OrdersExport($orders), 'P&D-CH.csv');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state = $request->state;
        $start = $request->from;
        $end  = $request->to;
        $name = $request->name;
        $id = $request->id;
        $phone_no = $request->phone_no;
        $notice_ambilan_ref = $request->notice_ambilan_ref;
        $canReopenOrder = Auth()->user()->can('reOpen order');
        $canCreateOrder = Auth()->user()->can('create orders');
        $customerService = Auth()->user()->hasRole('CustomerService');

        $orders = Order::join('customers', 'customers.id', '=', 'orders.customer_id')
            ->with('customer','comments')
            ->select('orders.*', 'customers.name', 'customers.phone_no')
            ->when($state, function ($q) use ($state) {
                return $q->where('state', $state);
            })
            ->when($id, function ($q) use ($id) {
                return $q->where('orders.id', $id);
            })
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('prefered_pickup_datetime', [$start, $end]);
            })
            ->when($name, function ($q) use ($name) {
                return $q->where('customers.name', 'ILIKE', '%' . $name . '%');
            })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('customers.phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->when($notice_ambilan_ref, function ($q) use ($notice_ambilan_ref) {
                return $q->where('orders.notice_ambilan_ref', 'ILIKE', '%' . $notice_ambilan_ref . '%');
            })
            ->orderBy('prefered_pickup_datetime', 'DESC')->paginate(10);

        return view('order.index', compact('orders', 'canReopenOrder', 'canCreateOrder',  'customerService' ))
            ->with('i', ($orders->get('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materials = Order::MATERIALS;
        $sizes = Order::SIZES;
        $availableStates = [Draft::class, PendingPickupSchedule::class];
        return view('order.create', compact('materials', 'sizes', 'availableStates'));
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
        $customer = Customer::findOrCreate($request->customer_name, formatPhoneNo($request->customer_phone_no));
        $order = new Order;
        $order->fill([
            'customer_id' => $customer->id,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'address_3' => $request->address_3,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'location_state' => $request->location_state,
            'price' => priceCents(array_sum($request->price_item)),
            'quantity' => array_sum($request->quantity_item),
            'prefered_pickup_datetime' => $request->prefered_pickup_datetime,
            'deposit_payment_method' => $request->deposit_payment_method,
            'deposit_paid_at' => $request->deposit_paid_at,
            'deposit_amount' => priceCents($request->deposit_amount),
            'discount_type' => $request->discount_type,
            'discount_rate' => $request->discount_rate,
            'notice_ambilan_ref' => $request->notice_ambilan_ref,
            'walk_in_customer' =>isset($request->walk_in_customer),
            'created_by' => Auth()->user()->id,
        ]);
        $order->save();

        $order_item = new OrderItem;
        for ($i = 0; $i < count((array)$request->material); $i++) {
            $data[] = [
                'order_id' => $order->id,
                'size' => $request->size[$i],
                'material' => $request->material[$i],
                'quantity' => $request->quantity_item[$i],
                'price' =>  priceCents($request->price_item[$i]),
                'created_at' => $order_item->freshTimestamp(),
                'updated_at' => $order_item->freshTimestamp()
            ];
        }
        $order_item->insert($data);

        return redirect()->route('order.show', $order->id)->with('Order is created.');
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
        $canReopenOrder = Auth()->user()->can('reOpen order');
        $encId = Crypt::encryptString($order->id);
        return view('order.show', compact('runnerJobImages', 'order', 'encId', 'canReopenOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $materials = Order::MATERIALS;
        $sizes = Order::SIZES;
        $availableStates = [Draft::class, PendingPickupSchedule::class];
        return view('order.edit', compact('order', 'materials', 'sizes', 'availableStates'));
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
            'walk_in_customer' =>isset($request->walk_in_customer) ,
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


    public function status(Order $order, Request $request)
    {
        $order->state->transitionTo($request->state);
        $order->load('customer');
        return $order;
    }

    protected function validateUpdateOrders()
    {
        return request()->validate([
            'prefered_pickup_datetime' => 'required',
            'address_1' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'location_state' => 'required'
        ]);
    }

    protected function validateCreateOrders()
    {
        $validateData = request()->validate(
            [
                'customer_name' => 'required',
                'customer_phone_no' => 'required',
                'material.*' => 'required',
                'size.*' => 'required',
                'price_item.*' => 'required',
                'quantity_item.*' => 'required',
                'prefered_pickup_datetime' => 'required|after_or_equal:today',
                'address_1' => 'required',
                'postcode' => 'required',
                'city' => 'required',
                'location_state' => 'required',
            ],
            [
                'material.*.required' => 'Please select a material.',
                'size.*.required' => 'Material size required.',
                'quantity_item.*.required' => 'Quantity item required.',
                'price_item.*.required' => 'Price item required.'
            ]
        );
        return $validateData;
    }
}