<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_compatibilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('asset_id')->unsigned();
            $table->bigInteger('trainz_build_id')->unsigned();
            $table->integer('state')->default(0)->comment("0: Rouge |1: Yellow |2: Green");

            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_compatibilities');
    }
}
