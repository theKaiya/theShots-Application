<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $q) {
            $q->increments('id');
            $q->string('username');
            $q->string('email')->unique();
            $q->string('password');
            $q->string('location')->nullable();
            $q->string('position')->nullable();
            $q->string('about')->nullable();
            $q->text('picture')->nullable();
            $q->text('settings')->nullable();
            $q->text('social')->nullable();
            $q->string('api_token', 60)->unique();
            $q->integer('is_admin')->nullable()->default(0);
            $q->integer('is_blocked')->nullable()->default(0);
            $q->integer('is_activated')->nullable()->default(0);
            $q->rememberToken();
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
        Schema::drop('users');
    }
}
