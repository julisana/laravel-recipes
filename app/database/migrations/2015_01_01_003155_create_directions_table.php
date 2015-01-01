<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directions', function($table)
        {
            $table->increments('id');
            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('added_by')->references('id')->on('users');

            $table->integer('direction_number')->unsigned();
            $table->string('direction');

            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('created_on')->unsigned();  //unix timestamp
            $table->foreign('updated_by')->references('id')->on('users');
            $table->integer('updated_on')->unsigned();  //unix timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directions');
    }

}
