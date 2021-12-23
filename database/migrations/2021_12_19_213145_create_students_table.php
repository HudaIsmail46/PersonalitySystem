<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            
            $table->bigIncrements('id');

            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('matric_no');

            $table->string('faculty');

            $table->string('department');

            $table->string('programme');

            $table->integer('year_in_progress');
            
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
        Schema::dropIfExists('students');
    }
}
