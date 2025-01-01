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
        Schema::create('sustains', function (Blueprint $table) {
            $table->id();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image1')->nullable();
            $table->enum('stutus',['active','passive'])->default('active')->nullable();
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
        Schema::dropIfExists('sustains');
    }
};
