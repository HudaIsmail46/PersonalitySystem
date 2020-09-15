<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            
            $table ->bigIncrements('id');
            $table ->text('event_title')->nullable();
            $table ->text('address')->nullable();
            $table ->dateTime('event_begins')->nullable();
            $table ->dateTime('event_ends')->nullable();
            $table ->text('description')->nullable();
            $table ->text('team')->nullable();
            $table ->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}