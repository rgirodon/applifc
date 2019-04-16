<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrainementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrainements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->date('date_entrainement');
            $table->text('comments');
            $table->timestamps();
            $table->foreign('club_id')->references('id')->on('clubs');            
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
        Schema::dropIfExists('entrainements');
    }
}
