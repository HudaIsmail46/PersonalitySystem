<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->renameColumn('address','address_1');
            $table->string('address_2')->nullable();
            $table->string('address_3')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('location_state')->nullable();
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
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('address_1');
            $table->dropColumn('address_2');
            $table->dropColumn('address_3');
            $table->dropColumn('postcode');
            $table->dropColumn('city');
            $table->dropColumn('location_state');
            $table->dropSoftDeletes();
        });
    }
}
