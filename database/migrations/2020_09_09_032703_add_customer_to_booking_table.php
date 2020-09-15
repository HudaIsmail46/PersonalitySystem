<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Booking;

class AddCustomerToBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->integer('phone_no')->nullable();
        });

        // $bookings = Booking::all();

        // foreach ($bookings as $booking)
        // {
        //     Booking::where('id', $booking->id)
        //     ->update($booking->name-> getCustomerName() );
        // }
    }

    // public function getCustomerName(){

    //     $name = Booking::select('description')->get();
    //     $pattern = "/(?:Name : )([A-Za-z ]+[.,]?[ ]+[\'|\-|\.?[A-Za-z ]+)?
    //     /";
    //     $output = [];
    //     $match = preg_match($pattern, $name, $output);
    //     // var_dump($output[]);
    // }

    // public function getPhoneNumber(){

    //     $name = Booking::select('description')->get();
    //     $pattern = "/(?:(?:\+6?([1-9]|[0-9][0-9]|[0-9][0-9][0-9])\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([0-9][1-9]|[0-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?
    //     /";
    //     $output = [];
    //     $match = preg_match($pattern, $name, $output);
    //     // var_dump($output[]);
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone_no');
        });
    }
}
