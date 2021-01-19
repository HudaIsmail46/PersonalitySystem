<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Booking;
use App\FollowUp;
use Carbon\Carbon;

class FollowUpCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingCreated  $event
     * @return void
     */
    public function handle(BookingCreated $event)
    {
        $bookings =Booking::all();

            $booking_customer_id = $event->booking->customer_id;

            if(Booking::doesntHave('followUp')->get()){


            }else{

                if($bookings->customer_id && FollowUp::get('customer_id')->exists()){

                   FollowUp::where('customer_id',$booking_customer_id)
                   ->update(['lead_status'=>"CLOSED"]);

                }
                else{

                    $data= new FollowUp;
                        $data->booking_id =$bookings->id;
                        $data->customer_id=$bookings->$booking_customer_id ;
                        $data->lead_status="PENDING";
                        $data->save();
                }
            }


    }
}