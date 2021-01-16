<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('member1_id')->nullable();
            $table->unsignedBigInteger('member2_id')->nullable();
            $table->unsignedBigInteger('member3_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams');  
            $table->foreign('member1_id')->references('id')->on('members');   
            $table->foreign('member2_id')->references('id')->on('members');          
            $table->foreign('member3_id')->references('id')->on('members'); 
            $table->date('date');         
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
        Schema::dropIfExists('team_members');
    }
}
