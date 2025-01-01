<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('name')->unique();
            $table->string('page_name')->unique()->nullable();
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('writer')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();

            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_keyphrase')->nullable();

            $table->enum('is_summary', ['yes', 'no'])->default('yes');
            $table->enum('is_article', ['yes', 'no'])->default('yes');

            $table->enum('show_footer', ['yes', 'no'])->default('yes');
            $table->enum('show_header', ['yes', 'no'])->default('yes');

            $table->enum('page_type', ['article', 'non-article', 'sitemap', 'other', 'legal'])->default('non-article');
            $table->enum('keep_alive', ['kill', 'keep_alive'])->default('keep_alive');
            $table->string('table')->default('pages');


            $table->enum('status', ['Publish', 'Unpublish'])->default('Publish');
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
        Schema::dropIfExists('pages');
    }
}
