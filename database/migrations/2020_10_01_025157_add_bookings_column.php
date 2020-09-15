<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->bigInteger('customer_id')->nullable();
            $table->dateTime('event_begins')->nullable();
            $table->dateTime('event_ends')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('deposit')->nullable();
            $table->string('handled_by')->nullable();
            $table->string('booking_type')->nullable();
            $table->string('team')->nullable();
            $table->integer('estimated_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('event_begins');
            $table->dropColumn('event_ends');
            $table->dropColumn('discount');
            $table->dropColumn('deposit');
            $table->dropColumn('handled_by');
            $table->dropColumn('booking_type');
            $table->dropColumn('team');
            $table->dropColumn('estimated_price');
            
        });
    }
}
