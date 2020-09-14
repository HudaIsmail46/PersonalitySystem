<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Booking;


class BookingController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::orderBy('id', 'ASC')->paginate(50);
        return view('booking.index', ['booking' => $bookings])
            ->with('i', ($bookings->get('page', 1) - 1) * 50);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::find($id);
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
    public function destroy($id)
    {
        Booking::destroy($id);
        return back()
            ->with('success', 'Booking deleted successfully');
    }

    protected function validateBooking()
    {
        return request()->validate([
            'event_title' => 'required',
            'address' => 'required',
            'event_begins' => 'required',
            'event_ends' => 'required',
            'description' => 'required',
            'team' => 'required'
        ]);
    }
}
