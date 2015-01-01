<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table)
        {
            $table->increments('id')->unsigned();

            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->boolean('active')->unsigned();

            $table->rememberToken();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('last_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}
