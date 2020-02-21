<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('asset_category_id')->unsigned();
            $table->string('name');

            $table->foreign('asset_category_id')->references('id')->on('asset_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_sub_categories');
    }
}
