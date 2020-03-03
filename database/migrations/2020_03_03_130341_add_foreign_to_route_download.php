<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToRouteDownload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('route_downloads', function (Blueprint $table) {
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
            //
        });
    }
}
