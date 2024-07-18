<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortofoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portofolios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('portofolio_category_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('title', 500)->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('portofolio_category_id')->references('id')->on('portofolio_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portofolios');
    }
}
