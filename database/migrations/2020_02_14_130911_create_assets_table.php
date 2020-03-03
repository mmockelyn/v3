<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('asset_category_id')->unsigned();
            $table->bigInteger('asset_sub_category_id')->unsigned();
            $table->string('designation');
            $table->string('short_description');
            $table->longText('description')->nullable();
            $table->string('kuid')->nullable();
            $table->string('downloadLink')->nullable();
            $table->integer('social')->default(0)->comment("Poster sur les reseaux sociaux ou non (twitter, facebook, etc...");
            $table->integer('published')->default(0)->comment("Publier ou non");
            $table->integer('countDownload')->default(0);
            $table->integer('mesh')->default(0)->comment("Mesh 3D disponble ou non");
            $table->integer('config')->default(0)->comment("Fichier config disponible ou non");
            $table->integer("pricing")->default(0)->comment("0: Free |1: Paid");
            $table->string('price')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->uuid('uuid');
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
        Schema::dropIfExists('assets');
    }
}
