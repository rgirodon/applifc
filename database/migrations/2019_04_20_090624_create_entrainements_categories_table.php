<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrainementsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrainements_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrainement_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('entrainement_id')->references('id')->on('entrainements');
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
        Schema::dropIfExists('entrainements_categories');
    }
}
