<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->string('title', 500)->nullable();
            $table->string('price', 100)->nullable();
            $table->string('price_false', 100)->nullable();
            $table->string('weight', 100)->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_posts');
    }
}
