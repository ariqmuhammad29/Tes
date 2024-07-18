<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_posts', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->dropColumn('product_category_id');
            $table->renameColumn('price', 'project_name');
            $table->renameColumn('price_false', 'designer');
            $table->renameColumn('weight', 'location');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_posts', function (Blueprint $table) {
            // Add the dropped columns back
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->foreign('product_category_id')->references('id')->on('product_categories');


            // Rename the columns back
            $table->renameColumn('project_name', 'price');
            $table->renameColumn('designer', 'price_false');
            $table->renameColumn('location', 'weight');

            // Drop the added column
            $table->dropColumn('status');
        });
    }
};
