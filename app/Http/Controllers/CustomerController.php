<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends AuthenticatedController
{
    public function fileExport()
    {
        $parsedUrl = parse_url(URL::previous());
        $query = $parsedUrl['query'] ?? '';

        return Excel::download(new CustomersExport($query), 'Customers-CleanHero.csv');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone_no = $request->phone_no;

        $customers = Customer::with('bookings', 'orders')
            ->when($name, function ($q) use ($name) {
                return $q->where('name', 'ILIKE', '%' . $name . '%');
            })
            ->when($address, function ($q) use ($address) {
                return $q->where('address_1', 'ILIKE', '%' . $address . '%')
                    ->orWhere('address_2', 'ILIKE', '%' . $address . '%')
                    ->orWhere('address_3', 'ILIKE', '%' . $address . '%');
            })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'LIKE', '%' . $phone_no . '%');
            })
            ->orderBy('id', 'ASC')->paginate(20);

        return view('customer.index', ['customers' => $customers])
            ->with('i', ($customers->get('page', 1) - 1) * 50);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCustomers();
        $customer = new Customer;
        $customer->fill([
            'name' => $request->name,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'address_3' => $request->address_3,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'location_state' => $request->location_state,
            'phone_no' => formatPhoneNo($request->phone_no),
            'phone_no_2' => formatPhoneNo($request->phone_no_2)
        ]);
        $customer->save();
        return redirect()->route('customer.show', $customer->id)->with('success', 'Customers created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validateCustomers();

        $customer->fill([
            'name' => $request->name,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'address_3' => $request->address_3,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'location_state' => $request->location_state,
            'phone_no' => formatPhoneNo($request->phone_no)
        ]);

        $customer->save();
        return redirect()->route('customer.show', $customer->id)->with('success', 'Customers updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customer.index')->with('Customer succesfully deleted.');
    }

    protected function validateCustomers()
    {
        return request()->validate([
            'name' => 'required',
            'phone_no' => 'required|unique:customers',
            'address_1' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'location_state' => 'required',
        ]);
    }
}
