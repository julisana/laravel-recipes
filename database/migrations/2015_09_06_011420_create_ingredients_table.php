<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('recipe_id')->nullable()->unsigned();
            $table->integer('order_number')->nullable()->unsigned();
            $table->string('ingredient')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('recipe_id')
                  ->references('id')
                  ->on('recipes')
                  ->onDelete('cascade');
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
