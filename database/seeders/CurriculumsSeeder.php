<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumsSeeder extends Seeder
{
    public function run()
    {
        // ダミーデータの挿入
        DB::table('curriculums')->insert([
            [
                'title' => '算数の基本',
                'thumbnail' => 'default_thumbnail.jpg',
                'description' => '算数の基礎を学ぶカリキュラムです。',
                'video_url' => 'https://example.com/video1',
                'alway_delivery_flg' => 1,
                'grade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '理科の実験',
                'thumbnail' => 'default_thumbnail.jpg',
                'description' => '楽しい理科の実験を体験できるカリキュラムです。',
                'video_url' => 'https://example.com/video2',
                'alway_delivery_flg' => 0,
                'grade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '社会の歴史',
                'thumbnail' => 'default_thumbnail.jpg',
                'description' => '歴史の重要なポイントを学びます。',
                'video_url' => 'https://example.com/video3',
                'alway_delivery_flg' => 1,
                'grade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
