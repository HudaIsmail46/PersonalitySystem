<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;


class CustomerController extends Controller
{
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

        $customers = Customer::when($name, function ($q) use ($name) {
            return $q->where('name', 'ILIKE', '%' . $name . '%');
        })
            ->when($address, function ($q) use ($address) {
                return $q->where('address', 'ILIKE', '%' . $address . '%');
            })
            ->when($phone_no, function ($q) use ($phone_no) {
                return $q->where('phone_no', 'ILIKE', '%' . $phone_no . '%');
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
            'address' => $request->address,
            'phone_no' => $this->formatPhoneNo($request->phone_no)
        ]);
        $customer->save();
        return back()->with('success', 'Customers created successfully.');
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
        $customer->update($this->validateCustomers());
        return back()->with('success', 'Customers updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return back()
            ->with('success', 'Customers deleted successfully');
    }

    protected function validateCustomers()
    {
        return request()->validate([
            'name' => 'required',
            'phone_no' => 'required',
            'address' => 'required',
        ]);
    }

    protected function formatPhoneNo($phone_no)
    {
        if (preg_match('/^6/', $phone_no) || preg_match('/[\[^\+\]]/', $phone_no)) {
            $phone_number = preg_replace('/\D+/', '', $phone_no);
        } else {
            $phone = preg_replace('/\D+/', '', $phone_no);
            $phone_number =  "6" . $phone;
        }
        return $phone_number;
    }
}
