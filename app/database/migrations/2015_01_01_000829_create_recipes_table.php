<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function($table)
        {
            $table->increments('id');

            $table->string('name');
            $table->text('description');
            $table->string('source');
            $table->string('source_url');
            $table->text('notes');
            $table->integer('prep_time')->unsigned();   //seconds
            $table->integer('cook_time')->unsigned();   //seconds

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
        Schema::dropIfExists('recipes');
    }

}
