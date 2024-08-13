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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')
            ->references('id')
            ->on('carts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('coupon_id')
            ->nullable()
            ->constrained('coupons')
            ->onDelete('set null')
            ->onUpdate('cascade'); 

            $table->string('note');
            $table->string('location');
            $table->decimal('deposit', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->enum('order_status', ['sent', 'checked', 'refused', 'inproccesing', 'done' , 'deliverd']);
            $table->enum('deposit_status', ['paid', 'notpaid'])->nullable();
            $table->enum('total_status', ['paid', 'notpaid' ,'partial_paid'])->nullable();
            $table->decimal('customization_price', 10, 2)->nullable()->default(0);
            $table->string('customization_description')->nullable()->default('none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
