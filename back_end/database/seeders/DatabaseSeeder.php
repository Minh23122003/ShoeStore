<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ShoesSeeder::class);
        $this->call(BillsSeeder::class);
        $this->call(RatingsSeeder::class);
        $this->call(CommentsSeeder::class);
    }
}
