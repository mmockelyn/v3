<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToTutoriel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tutoriels', function (Blueprint $table) {
            $table->integer('demo')->default(0);
            $table->string('linkDemo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tutoriels', function (Blueprint $table) {
            $table->removeColumn('demo');
            $table->removeColumn('linkDemo');
        });
    }
}
