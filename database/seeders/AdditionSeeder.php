<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addition = [
            ['addition' => 'addition1' ,'price' => 10],
            ['addition' => 'addition2' ,'price' => 20],
            ['addition' => 'addition3' ,'price' => 30],
            ['addition' => 'addition4' ,'price' => 40],
            ['addition' => 'addition5' ,'price' => 50],
            ['addition' => 'addition6' ,'price' => 60],
            ['addition' => 'addition7' ,'price' => 20],
            ['addition' => 'addition8' ,'price' => 40],
            ['addition' => 'addition9' ,'price' => 80],
         ];

        DB::table('additions')->insert($addition);
    }
    
}
