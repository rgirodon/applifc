<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->unsigned();
            $table->string('libelle');
            $table->text('comments')->nullable();
            $table->date('date_competition');
            $table->date('date_limite_reponse')->nullable();
            $table->enum('reponse', ['y', 'n'])->nullable();
            $table->timestamps();
            $table->foreign('club_id')->references('id')->on('clubs');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
