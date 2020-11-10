<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunnerJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runner_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('runner_schedule_id');
            $table->foreign('runner_schedule_id')->references('id')->on('runner_schedules');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->string('state')->nullable();
            $table->string('job_type');
            $table->datetime('completed_at')->nullable();
            $table->datetime('scheduled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runner_jobs');
    }
}
