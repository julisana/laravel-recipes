<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create( 'recipes', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' )->nullable();
            $table->string( 'difficulty' )->nullable();
            $table->text( 'description' )->nullable();
            $table->string( 'source' )->nullable();
            $table->string( 'source_url' )->nullable();
            $table->text( 'notes' )->nullable();
            $table->unsignedBigInteger( 'prep_time' )->default( 0 )->nullable();   //minutes
            $table->unsignedBigInteger( 'cook_time' )->default( 0 )->nullable();   //minutes
            $table->unsignedInteger( 'servings' )->nullable();       //how many servings
            $table->string( 'serving_size' )->nullable();                //what size the serving is (people, cups, etc)

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'recipes' );
    }
}
