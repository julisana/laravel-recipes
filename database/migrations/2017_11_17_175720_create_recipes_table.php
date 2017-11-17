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
            $table->unsignedInteger( 'user_id' )->nullable();        //author
            $table->string( 'name' )->nullable();
            $table->text( 'description' )->nullable();
            $table->string( 'source' )->nullable();
            $table->string( 'source_url' )->nullable();
            $table->text( 'notes' )->nullable();
            $table->unsignedBigInteger( 'prep_time' )->default( 0 );   //seconds
            $table->unsignedBigInteger( 'cook_time' )->default( 0 );   //seconds
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
