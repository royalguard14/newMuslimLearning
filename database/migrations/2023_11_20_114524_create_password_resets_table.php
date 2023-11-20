<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email');
            $table->string('token');
            $table->datetime('created_at')->nullable();
            $table->index(['email', 'token']);
        });
    }

       public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
