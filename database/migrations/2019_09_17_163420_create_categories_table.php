<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image1')->nullable();
            $table->tinyInteger('is_parent')->default('1');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('show_in_menu')->default('0');
            $table->enum('is_featured', ['yes', 'no'])->default('no');
            $table->tinyInteger('show_order')->default('0');
            $table->enum('banner_category', ['yes', 'no'])->default('no');
            $table->enum('status', ['Publish', 'Unpublish'])->default('Publish');
            $table->enum('category_type', ['keep_alive', 'kill'])->default('keep_alive');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('categories');
    }
}
