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
        Schema::create('tag_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')
            ->references('id')
            ->on('tags')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_products');
    }
};
