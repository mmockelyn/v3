<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_socials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('discord_id')->nullable();
            $table->string('discord_channel')->nullable();
            $table->string('pseudo_discord')->nullable();
            $table->string('pseudo_google')->nullable();
            $table->string('pseudo_microsoft')->nullable();
            $table->string('pseudo_twitch')->nullable();
            $table->string('pseudo_youtube')->nullable();
            $table->string('pseudo_trainz')->nullable();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_socials');
    }
}
