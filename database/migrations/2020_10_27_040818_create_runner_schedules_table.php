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
            $table->integer('runner_id')->unsigned();

            $table->foreign('runner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->datetime('scheduled_at')->nullable();
            $table->datetime('expected_at')->nullable();
            $table->datetime('started_at')->nullable();
            $table->datetime('completed_at')->nullable();
            $table->enum('status', ['draft', 'scheduled', 'on_route', 'completed'])->nullable();
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
