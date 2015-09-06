<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function($table)
        {
            $table->increments('id')->unsigned();

            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('source')->nullable();
            $table->string('source_url')->nullable();
            $table->text('notes')->nullable();
            $table->bigInteger('prep_time')->default(0)->unsigned();   //seconds
            $table->bigInteger('cook_time')->default(0)->unsigned();   //seconds

            $table->timestamps();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
