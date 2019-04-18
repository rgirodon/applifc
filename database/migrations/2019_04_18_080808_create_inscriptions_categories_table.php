<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inscription_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('inscription_id')->references('id')->on('inscriptions');
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
        Schema::dropIfExists('inscriptions_categories');
    }
}
