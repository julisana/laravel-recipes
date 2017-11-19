<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'recipe_user', function ( Blueprint $table ) {
            $table->unsignedInteger( 'recipe_id' )->index();
            $table->foreign( 'recipe_id' )
                ->references( 'id' )
                ->on( 'recipes' )
                ->onDelete( 'cascade' );

            $table->unsignedInteger( 'user_id' )->index();
            $table->foreign( 'user_id' )
                ->references( 'id' )
                ->on( 'users' )
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
        Schema::drop( 'recipe_user' );
    }
}
