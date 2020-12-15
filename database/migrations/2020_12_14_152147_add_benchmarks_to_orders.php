<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBenchmarksToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->datetime('collected_at')->nullable();
            $table->datetime('arrived_warehouse_at')->nullable();
            $table->datetime('vendor_collected_at')->nullable();
            $table->datetime('vendor_returned_at')->nullable();
            $table->datetime('leave_warehouse_at')->nullable();
            $table->datetime('returned_at')->nullable();
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
            $table->dropColumn('collected_at');
            $table->dropColumn('arrived_warehouse_at');
            $table->dropColumn('vendor_collected_at');
            $table->dropColumn('vendor_returned_at');
            $table->dropColumn('leave_warehouse_at');
            $table->dropColumn('returned_at');
        });
    }
}
