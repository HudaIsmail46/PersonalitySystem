<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('google_calendar_id');
            $table->string('team');
            $table->boolean('sync');
            $table->timestamps();
        });

        Schema::table('calendar_syncs', function (Blueprint $table) {
            $table->integer('google_calendar_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_calendars');
    }
}
