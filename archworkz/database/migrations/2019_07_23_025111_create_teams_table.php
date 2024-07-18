<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('role')->nullable();
            $table->string('phone')->nullable();
            $table->string('about', 1000)->nullable();
            $table->string('address', 1000)->nullable();
            $table->json('social_media')->nullable();
            $table->json('additional_info')->nullable();
            $table->integer('order_column');
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
        Schema::dropIfExists('teams');
    }
}
