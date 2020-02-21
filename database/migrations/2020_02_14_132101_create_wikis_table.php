<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wikis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wiki_category_id')->unsigned();
            $table->bigInteger('wiki_sub_category_id')->unsigned();
            $table->string('title');
            $table->longText('content');
            $table->integer('published')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('wiki_category_id')->references('id')->on('wiki_categories')->onDelete('cascade');
            $table->foreign('wiki_sub_category_id')->references('id')->on('wiki_sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wikis');
    }
}
