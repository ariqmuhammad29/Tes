<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title', 500)->nullable();
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('jam')->nullable();
            $table->enum('konfirmasi', ['1', '0'])->default('0');
            $table->integer('jumlah')->nullable();
            $table->enum('datang', ['1', '0'])->default('0');
            $table->integer('jumlah_datang')->nullable();
            $table->char('phone', 20)->unique()->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tamus');
    }
}
