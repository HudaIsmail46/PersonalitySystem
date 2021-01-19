<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use App\Customer;

use Carbon\Carbon;
use App\FollowUp;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;



class FollowUpLeadStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'follow_up_lead_status:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Follow Up Lead Status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // 1. Get booking data even begin  from 0-12month .
        // 2. Create loop to insert new data.
        // 3. if bookingid in bookings table exist in follow_ups table
        //         check if bookingid in bookings table have same customer_id && event_end < now,
        //            update the lead status in follow_up table to Closed.
        //    else
        //         insert booking_id,customer_id and lead status into follow_ups table.



        $bookings=Booking::with('followUp')->whereDate('event_begins','>=',Carbon::now()->subYears(1)->toDateTimeString())->get();

            foreach($bookings as $booking){

                if(Booking::with('followUp')->where('id','!=',FollowUp::get('booking_id')))
                {
                        $data= new FollowUp;
                        $data->booking_id =$booking->id;
                        $data->customer_id=$booking->customer->id;
                        $data->lead_status="CLOSED";
                        $data->save();

                }else{
                    if($booking->customer_id > 2 && $booking->event_begins > Carbon::now()){
                        $data= new FollowUp;
                        $data->booking_id =$booking->id;
                        $data->customer_id=$booking->customer->id;
                        $data->lead_status="PENDING";

                        $data->save();

                    }
                    // if(Booking::where('customer_id','>=','booking->id' && 'event_begins','>=',Carbon::now()) ){

                    //     $data= new FollowUp;
                    // $data->booking_id =$booking->id;
                    // $data->customer_id=$booking->customer->id;
                    // $data->lead_status="CLOSED";

                    // $data->save();
                    // }

                //         $folow=Booking::doesntHave('followUp')->get();
                // dd($folow);

                // $posts = Booking::whereDoesntHave('followUp', function (Builder $query) {
                //     $query->where('id', 'like', 'booking_id%');
                // })->get();
                // dd($posts);


                // $folow=Booking::find('id', $booking->id);
                // dd($folow);

            //     $folow = Booking::query()
            //  ->with(['followUp' => function($q) use($attDate,$type) {
            //      $q->where('present_date', $attDate);
            //      $q->wherePresentType($type);
            //  }])
            //  ->get();
            // $folow=Booking::where(function($query) {
            //     $query->has('followUp');
            // })->get();
            // dd($folow);

            // $folow=Booking::doesntHave('followUp')->get();
            //     dd($folow);

              // $id = DB::table('bookings')->select('id')->get()->values();
            // $booking_id= DB::table('follow_ups')->select('booking_id')->get()->values();
            // $diff= $id->diff_array($booking_id);
            // dd($diff);

                    }
            };
        $this->info("Done");



   }
}
