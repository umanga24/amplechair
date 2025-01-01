<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');

            
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            
            $table->string('thumbnail')->nullable();
            $table->text('youtube_link')->nullable();
            $table->string('youtube_video_id')->nullable();
            $table->string('writer')->nullable();
            $table->enum('status', ['Publish', 'Unpublish'])->default('Publish');
            $table->date('published_date')->nullable();
            
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_keyphrase')->nullable();
            
            $table->text('page_title')->nullable();
            $table->string('name')->unique();
            $table->integer('order')->nullable();
            $table->string('table')->default('posts');

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
        Schema::dropIfExists('posts');
    }
}
