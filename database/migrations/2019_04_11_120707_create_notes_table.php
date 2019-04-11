<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('coach_id')->references('id')->on('coachs');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
