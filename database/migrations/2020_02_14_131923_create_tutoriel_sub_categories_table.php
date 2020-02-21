<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorielSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoriel_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tutoriel_category_id')->unsigned();
            $table->string('name');
            $table->string('short')->nullable();

            $table->foreign('tutoriel_category_id')->references('id')->on('tutoriel_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutoriel_sub_categories');
    }
}
