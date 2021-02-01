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

class FollowUpController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $status = $request->status;
        $sales_person = $request->sales_person;
        $days = $request->days;

        $followUps = FollowUp::active()
            ->where('expire_at', '<=', Carbon::now()->addDays(7))
            ->when($status, function ($q) use ($status) {
                return $q->where('follow_up_status', '=', $status);
            })
            ->when($sales_person, function ($q) use ($sales_person) {
                return $q->where('sales_person', '=', $sales_person);
            })
            ->when($days, function ($q) use ($days) {
                return $q->whereDate('expire_at', '=', Carbon::now()->addDays((int)$days + 1));
            })
            ->orderBy('expire_at', 'asc')
            ->with('booking', 'customer.bookings')
            ->get();

        return view('follow_up.index', compact('followUps'));
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