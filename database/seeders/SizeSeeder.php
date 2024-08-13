<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = [
            ['size' => 'xs'],
            ['size' => 's'],
            ['size' => 'm'],
            ['size' => 'l'],
            ['size' => 'xl'],
            ['size' => 'xxl'],
            ['size' => 'xxxl'],
            ['size' => 'xxxxl'],
            ['size' => 'custom'],
        ];

        DB::table('sizes')->insert($sizes);
    }
}
    

