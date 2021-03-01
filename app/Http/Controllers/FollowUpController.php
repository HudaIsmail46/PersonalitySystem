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
        $lead_status = $request->lead_status;
        $follow_up_status = $request->follow_up_status;
        $sales_person = $request->sales_person;
        $to = $request->to ?? Carbon::now()->addDays(7)->toDateTimeString();
        $from = $request->from ?? Carbon::now()->toDateTimeString();

        $followUps = FollowUp::when($follow_up_status, function ($q) use ($follow_up_status) {
                return $q->where('follow_up_status', '=', $follow_up_status);
            })
            ->when($lead_status, function ($q) use ($lead_status) {
                return $q->where('lead_status', '=', $lead_status);
            })
            ->when($sales_person, function ($q) use ($sales_person) {
                return $q->where('sales_person', '=', $sales_person);
            })
            ->when($to, function ($q) use ($to) {
                return $q->whereDate('expire_at', '<=', $to);
            })
            ->when($from, function ($q) use ($from) {
                return $q->whereDate('expire_at', '>=', $from);
            })
            ->orderBy('expire_at', 'asc')
            ->with('booking', 'customer.bookings')
            ->paginate(20);

        return view('follow_up.index', compact('followUps')) ->with('i', ($followUps->get('page', 1) - 1) * 5);
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
            'follow_up_status' => $request->follow_up_status ? $request->follow_up_status : '' ,
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