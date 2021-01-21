<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('afinance_reference')->nullable();
            $table->datetime('invoice_date');
            $table->string('payer_name');
            $table->string('payer_email')->nullable();
            $table->string('payer_phone_no');
            $table->integer('total_amount');
            $table->string('status')->nullable();
            $table->json('additions')->nullable();
            $table->integer('booking_id');
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
        Schema::dropIfExists('invoices');
    }
}
