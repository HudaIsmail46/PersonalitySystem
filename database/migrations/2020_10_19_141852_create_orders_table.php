<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('size', ['xs','s','m','l','xl']);
            $table->string('material');
            $table->integer('price');
            $table->dateTime('prefered_pickup_datetime');
            $table->integer('actual_length')->nullable();
            $table->integer('actual_width')->nullable();
            $table->string('actual_material')->nullable();
            $table->integer('actual_price')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
