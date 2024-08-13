<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color' => 'Red', 'hex' => '#FF0000'],
            ['color' => 'Green', 'hex' => '#008000'],
            ['color' => 'Blue', 'hex' => '#0000FF'],
            ['color' => 'Yellow', 'hex' => '#FFFF00'],
            ['color' => 'Orange', 'hex' => '#FFA500'],
            ['color' => 'Purple', 'hex' => '#800080'],
            ['color' => 'Pink', 'hex' => '#FFC0CB'],
            ['color' => 'Brown', 'hex' => '#A52A2A'],
            ['color' => 'Black', 'hex' => '#000000'],
            ['color' => 'White', 'hex' => '#FFFFFF'],
            ['color' => 'Gray', 'hex' => '#808080'],
            ['color' => 'Cyan', 'hex' => '#00FFFF'],
            ['color' => 'Magenta', 'hex' => '#FF00FF'],
            ['color' => 'Lime', 'hex' => '#00FF00'],
            ['color' => 'Olive', 'hex' => '#808000'],
            ['color' => 'Teal', 'hex' => '#008080'],
            ['color' => 'Navy', 'hex' => '#000080'],
            ['color' => 'Maroon', 'hex' => '#800000'],
            ['color' => 'Coral', 'hex' => '#FF7F50'],
            ['color' => 'Salmon', 'hex' => '#FA8072'],
            ['color' => 'Turquoise', 'hex' => '#40E0D0'],
            ['color' => 'Gold', 'hex' => '#FFD700'],
            ['color' => 'Silver', 'hex' => '#C0C0C0'],
            ['color' => 'Lavender', 'hex' => '#E6E6FA'],
            ['color' => 'Indigo', 'hex' => '#4B0082'],
            ['color' => 'Violet', 'hex' => '#EE82EE'],
            ['color' => 'Khaki', 'hex' => '#F0E68C'],
            ['color' => 'Beige', 'hex' => '#F5F5DC'],
            ['color' => 'Mint', 'hex' => '#98FF98'],
            ['color' => 'Peach', 'hex' => '#FFE5B4'],
            ['color' => 'Plum', 'hex' => '#DDA0DD'],
            ['color' => 'Tan', 'hex' => '#D2B48C'],
            ['color' => 'Chocolate', 'hex' => '#D2691E'],
            ['color' => 'Crimson', 'hex' => '#DC143C'],
            ['color' => 'Fuchsia', 'hex' => '#FF00FF'],
            ['color' => 'Ivory', 'hex' => '#FFFFF0'],
            ['color' => 'Orchid', 'hex' => '#DA70D6'],
            ['color' => 'Periwinkle', 'hex' => '#CCCCFF'],
            ['color' => 'Slate', 'hex' => '#708090'],
            ['color' => 'Tomato', 'hex' => '#FF6347'],
            ['color' => 'Wheat', 'hex' => '#F5DEB3'],
            ['color' => 'Azure', 'hex' => '#F0FFFF'],
            ['color' => 'SeaGreen', 'hex' => '#2E8B57'],
            ['color' => 'Aqua', 'hex' => '#00FFFF'],
            ['color' => 'SkyBlue', 'hex' => '#87CEEB'],
            ['color' => 'Honeydew', 'hex' => '#F0FFF0'],
            ['color' => 'SlateGray', 'hex' => '#708090'],
            ['color' => 'ForestGreen', 'hex' => '#228B22'],
        ];

        DB::table('colors')->insert($colors);
    
    }
}
