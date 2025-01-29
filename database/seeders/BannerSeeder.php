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
        DB::table('banners')->insert([
            [
                'image' => 'banner/sample1.jpg',
            ],
            [
                'image' => 'banner/sample2.jpg',
            ],
            [
                'image' => 'banner/sample3.jpg',
            ],
        ]);
    }
}