<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_compatibilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('route_id')->unsigned();
            $table->bigInteger('trainz_build_id')->unsigned();
            $table->string('version');

            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->foreign('trainz_build_id')->references('id')->on('trainz_builds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_compatibilities');
    }
}
