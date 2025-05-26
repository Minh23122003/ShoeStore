<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Giay nam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giay nu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giay the thao',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
