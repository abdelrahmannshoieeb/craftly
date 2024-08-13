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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('detailes')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->decimal('stock');
            $table->decimal('discount_value')->nullable();

            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();
            $table->json('additions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
