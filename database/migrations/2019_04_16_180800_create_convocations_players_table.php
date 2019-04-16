<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvocationsPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations_players', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('convocation_id')->unsigned();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('player_id')->references('id')->on('players');
            $table->foreign('convocation_id')->references('id')->on('convocations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convocations_players');
    }
}
