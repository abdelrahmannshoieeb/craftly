<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['tag' => 'custom'],
            ['tag' => 'dress'],
            ['tag' => 'clothes'],
            ['tag' => 'fashion'],
            ['tag' => 'zara'],
            ['tag' => 'phone'],
            ['tag' => 'laptop'],
            ['tag' => 'ipad'],
            ['tag' => 'samsung'],
            ['tag' => 'apple'],
            ['tag' => 'technology'],
            ['tag' => 'trendy'],
        ];

        DB::table('tags')->insert($tags);
    }
}
