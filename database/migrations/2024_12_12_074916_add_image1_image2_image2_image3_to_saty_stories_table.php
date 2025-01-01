<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('saty_stories', function (Blueprint $table) {
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saty_stories', function (Blueprint $table) {
            $table->dropColumn('image1');
            $table->dropColumn('image2');
            $table->dropColumn('image3');         
        });
    }
};
