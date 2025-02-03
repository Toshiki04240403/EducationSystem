<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 既存のデータを削除
        DB::table('banners')->truncate();
        DB::table('banners')->insert([
            [
                'image' => 'storage\app\public\banners\image\sample1.jpg',
            ],
            [
                'image' => 'storage\app\public\banners\image\sample2.jpg',
            ],
            [
                'image' => 'storage\app\public\banners\image\sample3.jpg',
            ],
        ]);
    }
}