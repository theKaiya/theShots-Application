<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $q) {
            $q->increments('id');
            $q->integer('user_id')->unsigned()->nullable();
            $q->integer('comment_id')->unsigned()->nullable();
            $q->timestamps();
        });

        Schema::table('comment_likes', function (Blueprint $q) {
            $q->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $q->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
}
