<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_results', function (Blueprint $table) {
            $table->unsignedInteger('result_id');

            $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            
            $table->unsignedInteger('question_id');
            
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            
            $table->integer('points')->default(0);
            
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
        Schema::dropIfExists('questions_results');
    }
}
