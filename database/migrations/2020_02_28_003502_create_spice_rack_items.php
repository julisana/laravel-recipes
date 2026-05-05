<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpiceRackItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spice_rack_items', function (Blueprint $table) {
            $table->increments('id');

            $table->string( 'name' )->nullable();
            $table->string( 'type' )->nullable();
            $table->integer( 'count' )->nullable();
            $table->text( 'notes' )->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spice_rack_items');
    }
}
