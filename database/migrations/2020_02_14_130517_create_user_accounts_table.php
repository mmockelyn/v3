<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('last_login')->nullable();
            $table->ipAddress('last_ip')->nullable();
            $table->integer("avatar")->default(0)->comment("Si l'utilisateur possède un avatar ou non");
            $table->string('site_web')->nullable();
            $table->string("pseudo_twitter")->nullable();
            $table->string("pseudo_facebook")->nullable();
            $table->string('trainz_id')->nullable();
            $table->integer('point')->default(0)->comment("Nombre de point définie par l'achèvement de diverse action sur le site");

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_accounts');
    }
}
