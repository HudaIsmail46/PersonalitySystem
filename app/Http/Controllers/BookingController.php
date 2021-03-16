<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\Customer;
use App\InvoicePayment;
use App\Exports\BookingsExport;
use App\Invoice;
use App\InvoiceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\IssueInsurance;
use App\Agent;

class BookingController extends AuthenticatedController
{
    public function fileExport()
    {
        $parsedUrl = parse_url(URL::previous());
        $query = $parsedUrl['query'] ?? '';

        if ($query == '') {
            $bookings = Booking::all();
        } else {
            parse_str($query, $output);

            $id      = $output['id'];
            $name    = $output['name'];
            $phone   = $output['phone_no'];
            $start   = $output['from'];
            $end     = $output['to'];
            $agent   = $output['agent'];
            $address = $output['address'];
            $service_type = $output['service_type'];
            $corporate = $output['service_type'] == "COM" ? "CORP": "COM";
            $insured = $output['insured'] ?? '';

            $bookings = Booking::join('customers', 'customers.id', '=', 'bookings.customer_id')
                ->join('agent_assignments', 'agent_assignments.booking_id', '=','bookings.id')
                ->with('customer')
                ->select('bookings.*', 'customers.name', 'customers.phone_no', 'agent_assignments.agent_id')
                ->when($name, function ($q) use ($name) {
                    return $q->where('customers.name', 'ILIKE', '%' . $name . '%');
                })
                ->when($phone, function ($q) use ($phone) {
                    return $q->where('customers.phone_no', 'LIKE', '%' . $phone . '%');
                })
                ->when($id, function ($q) use ($id) {
                    return $q->where('bookings.id',$id);
                })
                ->when($start, function ($q) use ($start, $end) {
                    return $q->whereBetween('event_begins', [$start, $end]);
                })
                ->when($agent, function ($q) use ($agent) {
                    return $q->where('agent_assignments.agent_id', $agent);
                })
                ->when($service_type, function ($q) use ($service_type, $corporate) {
                    return $q->where('service_type', $service_type)->orWhere('service_type', $corporate);
                })
                ->when($insured, function ($q) use ($insured) {
                    return $q->whereNotNull('covernote_id');
                })
                ->when($address, function ($q) use ($address) {
                    return $q->where('bookings.address_1', 'ILIKE', '%' . $address . '%')
                        ->orWhere('bookings.address_2', 'ILIKE', '%' . $address . '%')
                        ->orWhere('bookings.address_3', 'ILIKE', '%' . $address . '%')
                        ->orWhere('bookings.postcode', 'ILIKE', '%' . $address . '%')
                        ->orWhere('bookings.city', 'ILIKE', '%' . $address . '%')
                        ->orWhere('bookings.location_state', 'ILIKE', '%' . $address . '%');
                })
                ->orderBy('event_begins', 'DESC')->get();
        }
        return Excel::download(new BookingsExport($bookings), 'bookings-CleanHero.csv');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id      = $request->id;
        $name    = $request->name;
        $phone   = $request->phone_no;
        $start   = $request->from;
        $end     = $request->to;
        $agent   = $request->agent;
        $address = $request->address;
        $service_type = $request->service_type;
        $corporate = $request->service_type == "COM" ? "CORP": "COM";
        $insured = $request->insured;

        $bookings = Booking::join('customers', 'customers.id', '=', 'bookings.customer_id')
            ->join('agent_assignments', 'agent_assignments.booking_id', '=','bookings.id')
            ->with('customer')
            ->select('bookings.*', 'customers.name', 'customers.phone_no', 'agent_assignments.agent_id')
            ->when($name, function ($q) use ($name) {
                return $q->where('customers.name', 'ILIKE', '%' . $name . '%');
            })
            ->when($phone, function ($q) use ($phone) {
                return $q->where('customers.phone_no', 'LIKE', '%' . $phone . '%');
            })
            ->when($id, function ($q) use ($id) {
                return $q->where('bookings.id',$id);
            })
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('event_begins', [$start, $end]);
            })
            ->when($agent, function ($q) use ($agent) {
                return $q->where('agent_assignments.agent_id', $agent);
            })
            ->when($service_type, function ($q) use ($service_type, $corporate) {
                return $q->where('service_type', $service_type)->orWhere('service_type', $corporate);
            })
            ->when($insured, function ($q) use ($insured) {
                return $q->whereNotNull('covernote_id');
            })
            ->when($address, function ($q) use ($address) {
                return $q->where('bookings.address_1', 'ILIKE', '%' . $address . '%')
                    ->orWhere('bookings.address_2', 'ILIKE', '%' . $address . '%')
                    ->orWhere('bookings.address_3', 'ILIKE', '%' . $address . '%')
                    ->orWhere('bookings.postcode', 'ILIKE', '%' . $address . '%')
                    ->orWhere('bookings.city', 'ILIKE', '%' . $address . '%')
                    ->orWhere('bookings.location_state', 'ILIKE', '%' . $address . '%');
            })
            ->orderBy('event_begins', 'DESC')->paginate(20);

        $agents = Agent::get();

        return view('booking.index', compact('bookings', 'agents'))
            ->with('i', ($bookings->get('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        $invoice_payments = $booking->payments;
        return view('booking.show', compact('booking', 'invoice_payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCreateBooking();
        $customer = Customer::findOrCreate($request->customer_name, formatPhoneNo($request->customer_phone_no));
        $booking = new Booking;
        $booking->fill([
            'customer_id' => $customer->id,
            'event_begins' => $request->event_begins,
            'event_ends' => $request->event_ends,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'address_3' => $request->address_3,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'location_state' => $request->location_state,
            'service_type' => $request->service_type,
            'discount' => priceCents($request->discount),
            'deposit' => priceCents($request->deposit),
            'pic' => $request->pic,
            'remarks' => $request->remarks,
            'estimated_price' => priceCents($request->estimated_price),
            'team' => $request->team,
        ]);
        $booking->save();

        return redirect()->route('booking.show', $booking->id)->with('Order is created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Booking $booking)
    {
        $booking->update($this->validateUpdateBooking());

        return redirect()->route('booking.show', $booking->id)->with('Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('Booking is deleted.');
    }


    public function purchase_insurance(Booking $booking)
    {
        if (!$booking->insured_at) {
            IssueInsurance::dispatchNow($booking);
        }

        return redirect()->route('booking.show', $booking->id);
    }

    protected function priceCents($price)
    {
        return $price ? $price * 100 : 0;
    }

    protected function validateCreateBooking()
    {
        $validateData = request()->validate([
            'customer_name' => 'required',
            'customer_phone_no' => 'required',
            'event_begins' => 'required',
            'event_ends' => 'required|after_or_equal:event_begins',
            'address_1' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'location_state' => 'required',
            'service_type' => 'required',
            'pic' => 'required'
        ]);

        return $validateData;
    }

    protected function validateUpdateBooking()
    {
        return request()->validate([
            'price' => 'required',
            'invoice_number' => 'max:10',
            'receipt_number' => 'max:6',
            'status' => 'required'
        ]);
    }
}
