<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteVersionGaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_version_gares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('route_version_id')->unsigned();
            $table->string('name_gare');
            $table->integer('type')->default(0)->comment("
            0: Gare Simple |
            1: Gare Départ / Terminus
            2: Grande Gare
            ");
            $table->string('lat');
            $table->string('long');
            $table->boolean('ter');
            $table->boolean('tgv');
            $table->boolean('metro');
            $table->boolean('bus');
            $table->boolean('tram');

            $table->foreign('route_version_id')->references('id')->on('route_versions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_version_gares');
    }
}
