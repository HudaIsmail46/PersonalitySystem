<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->enum('size', ['xs','s','m','l','xl']);
          $table->string('material');
          $table->string('price');
          $table->dateTime('prefered_pickup_datetime')->nullable();
          $table->double('actual_size')->nullable();
          $table->string('actual_material')->nullable();
          $table->double('actual_price');
          $table->string('images')->nullable();
          $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
