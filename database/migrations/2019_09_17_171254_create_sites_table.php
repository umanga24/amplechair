<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('company_name')->nullable();
            $table->string('country')->nullable();
            $table->string('district')->nullable();
            $table->text('map')->nullable();
            $table->string('location')->nullable();
            $table->string('municipality')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('ward_no')->nullable();
            $table->string('logo')->nullable();
            $table->string('media_logo')->nullable();
            $table->string('fab_icon')->nullable();

            $table->string('facebook_page')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('insta_id')->nullable();
            $table->string('pinterest_id')->nullable();
            $table->string('rss_id')->nullable();
            $table->string('youtube_channel')->nullable();


            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('email')->nullable();
            $table->enum('go_live', ['0', '1'])->default('1');
            $table->string('mail_sender_email')->nullable();


            // control tool
            $table->enum('sliders', ['yes', 'no'])->default('yes');
            $table->enum('categories', ['yes', 'no'])->default('yes');
            $table->enum('products', ['yes', 'no'])->default('yes');
            $table->enum('blogs', ['yes', 'no'])->default('yes');
            $table->enum('pages', ['yes', 'no'])->default('yes');
            $table->enum('orders', ['yes', 'no'])->default('yes');
            $table->enum('messages', ['yes', 'no'])->default('yes');
            $table->enum('subscribers', ['yes', 'no'])->default('yes');

            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('sites');
    }
}
