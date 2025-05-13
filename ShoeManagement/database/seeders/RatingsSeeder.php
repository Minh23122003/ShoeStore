<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'star' => 5,
                'content' => 'good',
                'user_id' => 1,
                'shoe_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'star' => 4,
                'content' => 'great',
                'user_id' => 1,
                'shoe_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'star' => 1,
                'content' => 'bad',
                'user_id' => 2,
                'shoe_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
