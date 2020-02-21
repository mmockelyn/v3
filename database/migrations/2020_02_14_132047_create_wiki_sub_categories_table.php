<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWikiSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('wiki_category_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('short');
            $table->string('icon');

            $table->foreign('wiki_category_id')->references('id')->on('wiki_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiki_sub_categories');
    }
}
