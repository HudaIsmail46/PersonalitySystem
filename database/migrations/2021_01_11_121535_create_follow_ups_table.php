<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('lead_status')->nullable();
            $table->string('follow_up_status')->nullable();
            $table->string('sales_person')->nullable();
            $table->datetime('sms_1')->nullable();
            $table->datetime('sms_2')->nullable();
            $table->datetime('sms_3')->nullable();
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
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->dropColumn('booking_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('lead_status');
            $table->dropColumn('follow_up_status');
            $table->dropColumn('sms_1');
            $table->dropColumn('sms_2');
            $table->dropColumn('sms_3');
            $table->dropSoftDeletes();
        });
    }
}
