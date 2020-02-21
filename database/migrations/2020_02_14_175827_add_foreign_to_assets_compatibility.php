<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToAssetsCompatibility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_compatibilities', function (Blueprint $table) {
            $table->foreign('trainz_build_id')->references('id')->on('trainz_builds')->onDelete('cascade');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('categorie_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_compatibilities', function (Blueprint $table) {
            //
        });
    }
}
