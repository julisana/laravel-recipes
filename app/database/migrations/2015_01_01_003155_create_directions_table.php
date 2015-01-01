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
            $table->integer('recipe_id')->unsigned();

            $table->integer('direction_number')->unsigned();
            $table->string('direction');

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
        Schema::dropIfExists('directions');
    }

}
