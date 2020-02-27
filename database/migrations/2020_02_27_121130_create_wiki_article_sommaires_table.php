<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiArticleSommairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_article_sommaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wiki_id')->unsigned();
            $table->string('title');

            $table->foreign('wiki_id')->references('id')->on('wikis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_article_sommaires');
    }
}
