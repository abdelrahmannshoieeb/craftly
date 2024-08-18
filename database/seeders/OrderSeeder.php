<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'cart_id' => 1,
                'user_id' => 2,
                'coupon_id' => 1,
                'note' => 'Please deliver after 5 PM',
                'location' => '123 Elm Street',
                'deposit' => 50.00,
                'total_price' => 150.00,
                'order_status' => 'sent',
                'deposit_status' => 'paid',
                'total_status' => 'partial_paid',
                'customization_price' => 10.00,
                'customization_description' => 'Additional engraving',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 1,
                'user_id' => 2,
                'coupon_id' => null,  
                'note' => 'Leave at the front door',
                'location' => '456 Oak Avenue',
                'deposit' => 0.00,
                'total_price' => 200.00,
                'order_status' => 'inproccesing',
                'deposit_status' => 'notpaid',
                'total_status' => 'notpaid',
                'customization_price' => 0.00,
                'customization_description' => 'None',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 1,
                'user_id' => 1,
                'coupon_id' => 1,  
                'note' => 'Leave at the front door',
                'location' => '456 Oak Avenue',
                'deposit' => 0.00,
                'total_price' => 200.00,
                'order_status' => 'deliverd',
                'deposit_status' => 'paid',
                'total_status' => 'notpaid',
                'customization_price' => 0.00,
                'customization_description' => 'None',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 1,
                'user_id' => 2,
                'coupon_id' => 1,  
                'note' => 'Leave at the front door',
                'location' => '456 Oak Avenue',
                'deposit' => 0.00,
                'total_price' => 200.00,
                'order_status' => 'done',
                'deposit_status' => 'notpaid',
                'total_status' => 'notpaid',
                'customization_price' => 0.00,
                'customization_description' => 'None',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cart_id' => 1,
                'user_id' => 2,
                'coupon_id' => 1,  
                'note' => 'Leave at the front door',
                'location' => '456 Oak Avenue',
                'deposit' => 0.00,
                'total_price' => 200.00,
                'order_status' => 'refused',
                'deposit_status' => 'paid',
                'total_status' => 'partial_paid',
                'customization_price' => 0.00,
                'customization_description' => 'None',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('orders')->insert($orders);
    }
    
}

