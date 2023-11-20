<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoLibraryTable extends Migration
{
    public function up()
    {
        Schema::create('video_library', function (Blueprint $table) {
            $table->id();
            $table->string('video_name', 255);
            $table->string('type', 50);
            $table->text('video_path');
            $table->text('description')->nullable();
            $table->string('pdf_note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_library');
    }
}

