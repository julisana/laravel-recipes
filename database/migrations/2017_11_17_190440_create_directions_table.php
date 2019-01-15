<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'directions', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'recipe_id' )->nullable();
            $table->unsignedInteger( 'order_number' )->default( 1 );
            $table->text( 'name' )->nullable();

            $table->timestamps();

            $table->foreign( 'recipe_id' )
                ->references( 'id' )
                ->on( 'recipes' )
                ->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'directions' );
    }
}
