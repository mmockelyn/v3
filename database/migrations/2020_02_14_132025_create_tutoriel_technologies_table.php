<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorielTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoriel_technologies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tutoriel_id')->unsigned();
            $table->string('name');

            $table->foreign('tutoriel_id')->references('id')->on('tutoriels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutoriel_technologies');
    }
}
