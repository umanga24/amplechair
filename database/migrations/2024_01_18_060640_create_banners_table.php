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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('client_banner')->nullable();
            $table->string('contact_banner')->nullable();
            $table->string('sustain_banner')->nullable();
            $table->string('media_banner')->nullable();
            $table->string('certificate_banner')->nullable();
            $table->string('team_banner')->nullable();
            $table->string('process_banner')->nullable();
            $table->string('career_banner')->nullable();
            $table->string('blog_banner')->nullable();
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
        Schema::dropIfExists('banners');
    }
};
