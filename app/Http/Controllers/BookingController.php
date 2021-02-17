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

            $name    = $output['name'];
            $phone   = $output['phone_no'];
            $start   = $output['from'];
            $end     = $output['to'];
            $team    = $output['team'];
            $address = $output['address'];
            $booking_type = $output['booking_type'];
            $corporate = $output['booking_type'] == "COM" ? "CORP": "COM";

            $bookings = Booking::join('customers', 'customers.id', '=', 'bookings.customer_id')
                ->with('customer')
                ->select('bookings.*', 'customers.name', 'customers.phone_no')
                ->when($name, function ($q) use ($name) {
                    return $q->where('customers.name', 'ILIKE', '%' . $name . '%');
                })
                ->when($phone, function ($q) use ($phone) {
                    return $q->where('customers.phone_no', 'LIKE', '%' . $phone . '%');
                })
                ->when($start, function ($q) use ($start, $end) {
                    return $q->whereBetween('event_begins', [$start, $end]);
                })
                ->when($team, function ($q) use ($team) {
                    return $q->where('team', $team);
                })
                ->when($booking_type, function ($q) use ($booking_type, $corporate) {
                    return $q->where('booking_type', $booking_type)->where('booking_type', $corporate);
                })
                ->when($address, function ($q) use ($address) {
                    return $q->where('address_1', 'ILIKE', '%' . $address . '%')
                        ->orWhere('address_2', 'ILIKE', '%' . $address . '%')
                        ->orWhere('address_3', 'ILIKE', '%' . $address . '%');
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
        $name    = $request->name;
        $phone   = $request->phone_no;
        $start   = $request->from;
        $end     = $request->to;
        $team    = $request->team;
        $address = $request->address;
        $booking_type = $request->booking_type;
        $corporate = $request->booking_type == "COM" ? "CORP": "COM";

        $bookings = Booking::join('customers', 'customers.id', '=', 'bookings.customer_id')
            ->with('customer')
            ->select('bookings.*', 'customers.name', 'customers.phone_no')
            ->when($name, function ($q) use ($name) {
                return $q->where('customers.name', 'ILIKE', '%' . $name . '%');
            })
            ->when($phone, function ($q) use ($phone) {
                return $q->where('customers.phone_no', 'LIKE', '%' . $phone . '%');
            })
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('event_begins', [$start, $end]);
            })
            ->when($team, function ($q) use ($team) {
                return $q->where('team', $team);
            })
            ->when($booking_type, function ($q) use ($booking_type, $corporate) {
                return $q->where('booking_type', $booking_type)->orWhere('booking_type', $corporate);
            })
            ->when($address, function ($q) use ($address) {
                return $q->where('address_1', 'ILIKE', '%' . $address . '%')
                    ->orWhere('address_2', 'ILIKE', '%' . $address . '%')
                    ->orWhere('address_3', 'ILIKE', '%' . $address . '%');
            })
            ->orderBy('event_begins', 'DESC')->paginate(10);

        $booking_teams = DB::select('select distinct team from bookings');
        $teams = array_map(function ($booking) {
            return $booking->team;
        }, $booking_teams);

        asort($teams);

        return view('booking.index', compact('bookings', 'teams'))
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
            'booking_type' => $request->booking_type,
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
            'booking_type' => 'required',
            'pic' => 'required',
            'team' => 'required'
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
