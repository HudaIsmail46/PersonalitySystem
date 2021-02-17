<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropBookingsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('booking_type');
            $table->dropColumn('handled_by');
            $table->dropColumn('gc_event_begins');
            $table->dropColumn('gc_event_ends');
        });
    }
}
