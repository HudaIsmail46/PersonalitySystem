<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','can: list bookings | edit bookings | delete bookings']);
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

        $bookings = Booking::when($name, function ($q) use ($name) {
                return $q->where('name', 'LIKE', '%' . $name . '%');
            })
            ->when($phone, function ($q) use ($phone) {
                return $q->where('phone_no', 'LIKE', '%' . $phone . '%');
            })
            ->when($start, function ($q) use ($start, $end) {
                return $q->whereBetween('gc_event_begins', [$start, $end]);
            })
            ->when($team, function ($q) use ($team) {
                return $q->where('gc_team', $team);
            })
            ->when($address, function ($q) use ($address) {
                return $q->where('gc_address',  'LIKE', '%' . $address . '%');
            })
            ->orderBy('gc_event_begins', 'DESC')->paginate(10);

        $booking_teams = DB::select('select distinct gc_team from bookings');
        $teams = array_map(function($booking){return $booking->gc_team;}, $booking_teams);

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
        return view('booking.show', compact('booking'));
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
        $this->validateBooking();
        Booking::create($request->all());
        return back()->with('success', 'Bookings created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $bookings)
    {
        return view('booking.edit', compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $bookings)
    {
        $bookings->update($this->validateBooking());
        return back()->with('success', 'Bookings updated successfully.');
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

    protected function validateBooking()
    {
        return request()->validate([
            'event_title' => 'required',
            'address' => 'required',
            'event_begins' => 'required',
            'event_ends' => 'required|after_or_equal:event_begins',
            'description' => 'required',
            'team' => 'required'
        ]);
    }
}
