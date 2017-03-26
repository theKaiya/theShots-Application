<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShotImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shot_images', function (Blueprint $q) {
            $q->increments('id');
            $q->integer('user_id')->nullable()->unsigned();
            $q->integer('shot_id')->nullable()->unsigned();
            $q->string('image');
            $q->string('path');
            $q->integer('is_preview')->default(0);
            $q->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shot_images');
    }
}
