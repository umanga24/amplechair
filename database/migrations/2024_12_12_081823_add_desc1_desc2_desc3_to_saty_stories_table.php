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
            $table->longText('desc1')->nullable();
            $table->longText('desc2')->nullable();
            $table->longText('desc3')->nullable();
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
            $table->dropColumn('desc1');
            $table->dropColumn('desc2');
            $table->dropColumn('desc3');
        });
    }
};
