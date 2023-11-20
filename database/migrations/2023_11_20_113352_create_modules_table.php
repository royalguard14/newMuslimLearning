<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->text('description');
            $table->string('routeUri');
            $table->string('icon');
            $table->string('default_url');
            $table->string('encryptname');
            $table->timestamps();
        });
    }

       public function down()
    {
        Schema::dropIfExists('modules');
    }
}
