<?php

namespace App\Http\Controllers;

use App\FollowUp;
use App\Booking;
use App\Customer;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Booking $booking)
    {

        $sixMonth = Booking::whereDate('event_begins', '<' , Carbon::now()->subDays(3)->toDateTimeString())->orderBy('event_begins', 'ASC')->paginate(50);
        $twelveMonth = Booking::whereDate('event_begins', '>=' , Carbon::now()->subDays(3)->toDateTimeString())->orderBy('event_begins', 'ASC')->paginate(50);

        $bookings=Booking::with('followUp')->get();

        return view('follow_up.index', compact('sixMonth', 'twelveMonth','bookings'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function show(FollowUp $followUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function edit(FollowUp $followUp)
    {
        return view('follow_up.edit', compact('followUp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,FollowUp $followUp)
    {
        $followUp->fill([
            'follow_up_status' => $request->follow_up_status,
            'sales_person' => $request->sales_person
        ]);
          $followUp->save();
          return redirect()->route('follow_up.index', $followUp->id)->with('success', 'Customers updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FollowUp  $followUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(FollowUp $followUp)
    {
        //
    }

    protected function validateFollowUp()
    {
        return request()->validate([
            'booking_id' => 'required',
            'customer_id' => 'required',
            'lead_status' => 'required',
        ]);
    }
}