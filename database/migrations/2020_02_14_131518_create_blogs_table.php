<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('categorie_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('short_content');
            $table->longText('content');
            $table->integer('published')->default(0)->comment("0: Non Publier |1: Publier");
            $table->timestamp('published_at')->nullable();
            $table->integer('twitter')->default(0)->comment("Si publier sur twitter");
            $table->text("twitterText")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
