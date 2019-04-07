<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->date('starts_at');
            $table->date('ends_at');
            $table->boolean('paid');
            $table->text('comments');
            $table->timestamps();
            $table->foreign('club_id')->references('id')->on('clubs');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licences');
    }
}
