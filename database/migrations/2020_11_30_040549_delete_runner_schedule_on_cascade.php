<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteRunnerScheduleOnCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('runner_jobs', function (Blueprint $table) {
            $table->dropForeign('runner_jobs_runner_schedule_id_foreign');
            $table->foreign('runner_schedule_id')
                ->references('id')->on('runner_schedules')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('runner_jobs', function (Blueprint $table) {
            $table->dropForeign('runner_jobs_runner_schedule_id_foreign');
        });
    }
}
