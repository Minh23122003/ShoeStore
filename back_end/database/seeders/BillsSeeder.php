<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bills')->insert([
            [
                'quantity' => 3,
                'size' => 39,
                'payment_at' => now(),
                'user_id' => 1,
                'shoe_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quantity' => 1,
                'size' => 40,
                'payment_at' => now(),
                'user_id' => 1,
                'shoe_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quantity' => 2,
                'size' => 35,
                'payment_at' => null,
                'user_id' => 1,
                'shoe_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quantity' => 3,
                'size' => 38,
                'payment_at' => now(),
                'user_id' => 2,
                'shoe_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quantity' => 5,
                'size' => 41,
                'payment_at' => null,
                'user_id' => 2,
                'shoe_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
