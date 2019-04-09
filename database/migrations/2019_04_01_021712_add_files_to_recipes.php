<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesToRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'recipes', function ( Blueprint $table ) {
            $table->text( 'files' )->nullable()->after( 'serving_size' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'recipes', function ( Blueprint $table ) {
            $table->dropColumn( 'files' );
        } );
    }
}
