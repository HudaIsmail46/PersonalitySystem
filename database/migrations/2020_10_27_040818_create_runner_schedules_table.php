<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunnerSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runner_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('runner_id',['1','2','3']);
            $table->datetime('scheduled_at')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('expected_complete')->nullable();
            $table->datetime('complete_at')->nullable();
            $table->enum('status', ['draft','scheduled','compete'])->nullable();
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
        Schema::dropIfExists('runner_schedules');
    }
}
