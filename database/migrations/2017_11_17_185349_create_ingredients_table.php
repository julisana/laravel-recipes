<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create( 'ingredients', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'recipe_id' )->nullable();
            $table->unsignedInteger( 'order_number' )->default( 1 );
            $table->string( 'name' )->nullable();
            $table->text( 'notes' )->nullable();

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
        Schema::dropIfExists( 'ingredients' );
    }
}
