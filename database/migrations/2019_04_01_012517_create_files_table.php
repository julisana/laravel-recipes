<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'files', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'recipe_id' )->nullable();
            $table->unsignedInteger( 'order_number' )->default( 1 );
            $table->string( 'type' )->nullable()->index();
            $table->string( 'path' )->nullable();
            $table->text( 'caption' )->nullable();

            $table->timestamps();
            $table->softDeletes();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'files' );
    }
}
