<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiArticleContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_article_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wiki_id')->unsigned();
            $table->bigInteger('sommaire_id')->unsigned();
            $table->text('content');

            $table->foreign('wiki_id')->references('id')->on('wikis')->onDelete('cascade');
            $table->foreign('sommaire_id')->references('id')->on('wiki_article_sommaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_article_contents');
    }
}
