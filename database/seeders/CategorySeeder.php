<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Electronics',
                'description' => 'Devices and gadgets',
                'details' => 'Various electronic devices and gadgets.',
                'images' => 'saasd.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clothing',
                'description' => 'Apparel and accessories',
                'details' => 'Men and women clothing and accessories.',
                'images' => 'saasd.png',

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Furniture',
                'description' => 'Home and office furniture',
                'details' => 'Comfortable and stylish furniture for home and office.',
                'images' => 'saasd.png',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
