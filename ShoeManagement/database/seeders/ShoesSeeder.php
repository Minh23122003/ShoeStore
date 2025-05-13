<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shoes')->insert([
            [
                'name' => 'Giay sandas',
                'information' => 'giay sandas thi re',
                'quantity' => 100,
                'price' => 1000000,
                'image' => 'image/upload/sandas.png',
                'note' => 'Khong co',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giay nike',
                'information' => 'giay nike la loai giay tot',
                'quantity' => 50,
                'price' => 2000000,
                'image' => 'image/upload/nike.png',
                'note' => 'ban si',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giay adidas',
                'information' => 'giay adidas ben',
                'quantity' => 80,
                'price' => 1500000,
                'image' => 'image/upload/adidas.png',
                'note' => 'Khong ban le',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giay bitis',
                'information' => 'giay bitis dep',
                'quantity' => 75,
                'price' => 1400000,
                'image' => 'image/upload/bitis.png',
                'note' => 'Khong hoan tra',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Giay puma',
                'information' => 'giay puma noi tieng',
                'quantity' => 90,
                'price' => 1800000,
                'image' => 'image/upload/puma.png',
                'note' => 'Doi tra trong vong 1 thang',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
