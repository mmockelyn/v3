<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorielCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoriel_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tutoriel_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->longText('content');
            $table->integer('published')->default(1)->comment("Publier ou non");
            $table->timestamp('published_at')->nullable();

            $table->foreign('tutoriel_id')->references('id')->on('tutoriels')->onDelete('cascade');
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
        Schema::dropIfExists('tutoriel_comments');
    }
}
