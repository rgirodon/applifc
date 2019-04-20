<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvocationsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convocations_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('convocation_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('convocation_id')->references('id')->on('convocations');
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
        Schema::dropIfExists('convocations_categories');
    }
}
