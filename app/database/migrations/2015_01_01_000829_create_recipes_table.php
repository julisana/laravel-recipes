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

            $table->integer('created_by')->unsigned();
            $table->timestamp('created_at');
            $table->integer('updated_by')->unsigned();
            $table->timestamp('updated_at');
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