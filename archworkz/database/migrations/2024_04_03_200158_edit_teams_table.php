<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('social_media');
            $table->dropColumn('additional_info');
            $table->string('slug')->unique()->before('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('social_media');
            $table->string('additional_info');
            $table->dropColumn('slug');
        });
    }
};
