<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invitation_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('invitation_id')->references('id')->on('invitations');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations_categories');
    }
}
