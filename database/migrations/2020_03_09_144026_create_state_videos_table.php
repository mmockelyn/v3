<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_videos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tutoriel_id')->unsigned();
            $table->timestamps();

            $table->foreign('tutoriel_id')->references('id')->on('tutoriels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_videos');
    }
}
