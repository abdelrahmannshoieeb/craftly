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
        Schema::table('product_sizes', function (Blueprint $table) {
            $table->string('size_image')->nullable(); 
        });
        Schema::table('product_colors', function (Blueprint $table) {
            $table->string('color_image')->nullable(); 
        });
        Schema::table('product_additions', function (Blueprint $table) {
            $table->string('addition_image')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('size_image')->nullable(); 
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('color_image')->nullable(); 
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('addition_image')->nullable(); 
        });
    }
};
