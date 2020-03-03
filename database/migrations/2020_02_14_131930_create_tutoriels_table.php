<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoriels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tutoriel_category_id')->unsigned();
            $table->bigInteger('tutoriel_sub_category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('short_content');
            $table->longText('content')->nullable();
            $table->integer('published')->default(0)->comment("Publier ou non");
            $table->string('pathVideo')->nullable()->comment("Ou est la vidéo sur le serveur (/tmp/video.mp4)");
            $table->integer('source')->default(0)->comment("Source tutoriel disponible ou non");
            $table->integer('premium')->default(0)->comment("Tutoriel disponible pour les premiums");
            $table->string('time')->nullable()->comment("Durée de la vidéo");
            $table->timestamp('published_at')->nullable();
            $table->integer('demo')->default(0);
            $table->string('linkDemo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutoriels');
    }
}
