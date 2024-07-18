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
        Schema::table('social_media', function (Blueprint $table){
            $table->renameColumn('title', 'instagram');
            $table->dropColumn('type');
            $table->renameColumn('url', 'facebook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_media', function (Blueprint $table){
            $table->renameColumn('instagram', 'title');
            $table->string('type');
            $table->renameColumn('facebook', 'url');
        });
    }
};

