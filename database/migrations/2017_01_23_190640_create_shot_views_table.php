<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShotViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shot_views', function (Blueprint $q) {
            $q->increments('id');
            $q->string('user_ip')->default(0);
            $q->integer('user_id')->nullable()->unsigned();
            $q->integer('shot_id')->nullable()->unsigned();
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
        Schema::dropIfExists('shot_views');
    }
}
