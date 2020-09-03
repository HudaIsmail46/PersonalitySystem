<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Booking;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $booking = Booking::find($id);
        return view('booking.index', compact('booking'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bookings = Booking::orderBy('id','ASC')->paginate(50);
        return view('booking.show', ['booking' => $bookings])
        ->with('i', ($bookings->get('page', 1) - 1) * 50);;
          
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
        $booking = new Booking($this->validateBooking());
      //  $article->user_id = 1;  //auth()->id()
        
        $booking->save();

        return redirect(route('booking.show'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $booking->update($this->validateBooking());
        
        return redirect($booking->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        return view('booking.show', ['booking' => $bookings]);
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
