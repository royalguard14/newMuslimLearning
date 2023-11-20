<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_access', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('status');
            $table->string('logs')->nullable();
            $table->string('remarks');
            $table->timestamps();
        });
    }

       public function down()
    {
        Schema::dropIfExists('ip_address');
    }
}
