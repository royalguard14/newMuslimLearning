<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTable extends Migration
{
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('group');
            $table->text('modules');
            $table->integer('log')->nullable();
            $table->timestamps(); // This will create created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('role');
    }
}
