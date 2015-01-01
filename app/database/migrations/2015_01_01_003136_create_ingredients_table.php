<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function($table)
        {
            $table->increments('id');
            $table->integer('recipe_id')->unsigned();

            $table->string('quantity');
            $table->string('name');
            $table->text('notes');

            $table->integer('created_by')->unsigned();
            $table->integer('created_on')->unsigned();  //unix timestamp
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }

}
