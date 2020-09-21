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

            $table->bigIncrements('id');
            $table->string('ga_event_title')->nullable();
            $table->text('ga_address')->nullable();
            $table->dateTime('ga_event_begins')->nullable();
            $table->dateTime('ga_event_ends')->nullable();
            $table->text('ga_description')->nullable();
            $table->string('ga_team')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('status')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->integer('price')->nullable();
            $table->string('service_type')->nullable();
            $table->timestamps();

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
