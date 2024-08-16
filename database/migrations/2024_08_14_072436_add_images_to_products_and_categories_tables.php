<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       
        Schema::table('products', function (Blueprint $table) {
            $table->json('images'); 
            $table->json('gallery')->nullable();  
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->json('images'); 
            $table->json('gallery')->nullable(); 

        });
    }

 
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('images'); 
            $table->dropColumn('gallery')->nullable();  

        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('images'); 
            $table->dropColumn('gallery')->nullable();  

        });
    }
};
