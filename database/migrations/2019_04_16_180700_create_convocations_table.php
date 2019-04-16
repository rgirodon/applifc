<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table->integer('coach_id')->unsigned();
            $table->date('date_convocation');
            $table->string('description');
            $table->string('heure_lieu');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('convocations');
    }
}
