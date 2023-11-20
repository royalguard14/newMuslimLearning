<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('first_name');
            $table->text('middle_name')->nullable();
            $table->text('last_name');
            $table->text('suffix_name')->nullable();
            $table->text('resumefile')->nullable();
            $table->string('image', 255)->nullable();
            $table->tinyInteger('online');
            $table->tinyInteger('active');
            $table->integer('role');
            $table->text('username');
            $table->text('password');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
