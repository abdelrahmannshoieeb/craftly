<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'user_id' => '1',
                'username' =>'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => '3',              
                'username' =>'user',
                'created_at' => now(),
                'updated_at' => now(),
                ''
            ],
            [
                'user_id' => '2',    
                'username' =>'user',           
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
