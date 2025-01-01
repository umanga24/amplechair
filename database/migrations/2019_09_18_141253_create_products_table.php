<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('title');
            $table->text('summary')->nullable();
            $table->text('highlight')->nullable();
            $table->text('description')->nullable();
            $table->longText('product_description')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->string('path')->nullable();
            // $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->double('price', 15, 2)->nullable();
            $table->float('discount')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            // $table->string('SKU')->unique();
            $table->text('search')->nullable();
            // $table->unsignedBigInteger('vendor')->nullable();
            $table->boolean('sale', [0, 1])->default(0);
            $table->boolean('is_featured', [0,1])->default(0);
            $table->boolean('is_other', [0,1])->default(0);
            $table->string('image')->nullable();
            $table->enum('status', ['Publish', 'Unpublish'])->default('Publish');
            // $table->enum('type', ['hot', 'new', 'none'])->default('none');
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyphrase')->nullable();
            $table->BigInteger('view')->nullable();
            $table->unsignedBigInteger('added_by')->nullable();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
            // $table->foreign('vendor')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            // $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('products');
    }
}
