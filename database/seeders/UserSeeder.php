<?php

namespace Database\Seeders;

use \Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => Hash::make('password123'),
                'location' => 'Head Office',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agent User',
                'email' => 'agent@example.com',
                'role' => 'agent',
                'password' => Hash::make('password123'),
                'location' => 'Regional Office',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Client User 1',
                'email' => 'client1@example.com',
                'role' => 'client',
                'password' => Hash::make('password123'),
                'location' => 'City A',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Client User 2',
                'email' => 'client2@example.com',
                'role' => 'client',
                'password' => Hash::make('password123'),
                'location' => 'City B',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Client User 3',
                'email' => 'client3@example.com',
                'role' => 'client',
                'password' => Hash::make('password123'),
                'location' => 'City C',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    }

