<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteOrderOnCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('runner_jobs', function (Blueprint $table) {
            $table->dropForeign('runner_jobs_order_id_foreign');
            $table->foreign('order_id')
                ->references('id')->on('orders')
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
            $table->dropForeign('runner_jobs_order_id_foreign');
        });
    }
}
