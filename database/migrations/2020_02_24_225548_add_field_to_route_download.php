<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToRouteDownload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_downloads', function (Blueprint $table) {
            $table->bigInteger('route_id')->unsigned();
            $table->string('version');
            $table->string('build');
            $table->bigInteger('route_type_download_id')->unsigned();
            $table->bigInteger('route_type_release_id')->unsigned();
            $table->string('linkDownload');
            $table->longText('note')->nullable();
            $table->integer('published')->default(0)->comment("Publier ou non");
            $table->timestamps();

            $table->foreign('route_type_download_id')->references('id')->on('route_type_downloads')->onDelete('cascade');
            $table->foreign('route_type_release_id')->references('id')->on('route_type_releases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('route_downloads', function (Blueprint $table) {
            $table->removeColumn('route_id');
            $table->removeColumn('version');
            $table->removeColumn('build');
            $table->removeColumn('route_type_download_id');
            $table->removeColumn('route_type_release_id');
            $table->removeColumn('linkDownload');
            $table->removeColumn('note');
            $table->removeColumn('published');
            $table->removeColumn('created_at');
            $table->removeColumn('updated_at');
        });
    }
}
