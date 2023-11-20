<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('video_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vidlib_id');
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->integer('downloads')->default(0);
            $table->unsignedBigInteger('uploader');
            $table->timestamps();

     
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_details');
    }
}
