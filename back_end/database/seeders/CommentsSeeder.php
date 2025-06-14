<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'content' => 'good',
                'user_id' => 1,
                'shoe_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'great',
                'user_id' => 1,
                'shoe_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'bad',
                'user_id' => 2,
                'shoe_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
