<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            
            $table->dropColumn('size');
            $table->dropColumn('material');
            $table->dropColumn('actual_length');
            $table->dropColumn('actual_width');
            $table->dropColumn('actual_material');
            $table->dropColumn('actual_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('size')->nullable();
            $table->string('material')->nullable();
            $table->integer('actual_length')->nullable();
            $table->integer('actual_width')->nullable();
            $table->string('actual_material')->nullable();
            $table->string('actual_price')->nullable();
        });
    }
}
