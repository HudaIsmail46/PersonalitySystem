<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('y_factor');
            $table->float('x_factor');
            $table->integer('invoice_ch_total_cku');
            $table->integer('invoice_ch_total_mcs');
            $table->integer('invoice_robin_total_cku');
            $table->integer('invoice_robin_total_mcs');
            $table->integer('quotation_ch_total_cku');
            $table->integer('quotation_ch_total_mcs');
            $table->integer('quotation_robin_total_cku');
            $table->integer('quotation_robin_total_mcs');
            $table->json('jobs');
            $table->float('ch_count');
            $table->float('robin_count');
            $table->integer('quotation_ch_prods');
            $table->integer('invoice_ch_prods');
            $table->integer('quotation_robin_prods');
            $table->integer('invoice_robin_prods');
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
        Schema::dropIfExists('daily_reports');
    }
}
