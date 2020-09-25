<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarSyncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_syncs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('sync_at');
            $table->json('raw_response');
            $table->string('sync_token')->nullable();
            $table->string('next_sync_token')->nullable();
            $table->string('calendar_id');
            $table->index('sync_token');
            $table->index('calendar_id');
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
        Schema::dropIfExists('calendar_syncs');
    }
}
