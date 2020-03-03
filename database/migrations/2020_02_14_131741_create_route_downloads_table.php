<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteDownloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_downloads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('route_id')->unsigned();
            $table->string('version');
            $table->string('build');
            $table->bigInteger('route_type_download_id')->unsigned();
            $table->bigInteger('route_type_release_id')->unsigned();
            $table->string('linkDownload');
            $table->longText('note')->nullable();
            $table->integer('published')->default(0)->comment("Publier ou non");
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_downloads');
    }
}
