<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('curriculums')->insert([
            [
                'title' => 'サンプルカリキュラム1',
                'thumbnail' => 'sample1.jpg',
                'description' => 'これはサンプルカリキュラム1の説明です。',
                'video_url' => 'https://example.com/video1',
                'alway_delivery_flg' => 1,
                'grade_id' => 2, // 小学1年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム2',
                'thumbnail' => 'sample2.jpg',
                'description' => 'これはサンプルカリキュラム2の説明です。',
                'video_url' => 'https://example.com/video2',
                'alway_delivery_flg' => 1,
                'grade_id' => 3, // 小学2年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム3',
                'thumbnail' => 'sample3.jpg',
                'description' => 'これはサンプルカリキュラム3の説明です。',
                'video_url' => 'https://example.com/video3',
                'alway_delivery_flg' => 1,
                'grade_id' => 4, // 小学3年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム4',
                'thumbnail' => 'sample4.jpg',
                'description' => 'これはサンプルカリキュラム4の説明です。',
                'video_url' => 'https://example.com/video4',
                'alway_delivery_flg' => 1,
                'grade_id' => 5, // 小学4年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム5',
                'thumbnail' => 'sample5.jpg',
                'description' => 'これはサンプルカリキュラム5の説明です。',
                'video_url' => 'https://example.com/video5',
                'alway_delivery_flg' => 1,
                'grade_id' => 6, // 小学5年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム6',
                'thumbnail' => 'sample6.jpg',
                'description' => 'これはサンプルカリキュラム6の説明です。',
                'video_url' => 'https://example.com/video6',
                'alway_delivery_flg' => 1,
                'grade_id' => 7, // 小学6年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム7',
                'thumbnail' => 'sample7.jpg',
                'description' => 'これはサンプルカリキュラム7の説明です。',
                'video_url' => 'https://example.com/video7',
                'alway_delivery_flg' => 1,
                'grade_id' => 8, // 中学1年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム8',
                'thumbnail' => 'sample8.jpg',
                'description' => 'これはサンプルカリキュラム8の説明です。',
                'video_url' => 'https://example.com/video8',
                'alway_delivery_flg' => 1,
                'grade_id' => 9, // 中学2年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム9',
                'thumbnail' => 'sample9.jpg',
                'description' => 'これはサンプルカリキュラム9の説明です。',
                'video_url' => 'https://example.com/video9',
                'alway_delivery_flg' => 1,
                'grade_id' => 10, // 中学3年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム10',
                'thumbnail' => 'sample10.jpg',
                'description' => 'これはサンプルカリキュラム10の説明です。',
                'video_url' => 'https://example.com/video10',
                'alway_delivery_flg' => 1,
                'grade_id' => 11, // 高校1年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム11',
                'thumbnail' => 'sample11.jpg',
                'description' => 'これはサンプルカリキュラム11の説明です。',
                'video_url' => 'https://example.com/video11',
                'alway_delivery_flg' => 1,
                'grade_id' => 12, // 高校2年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプルカリキュラム12',
                'thumbnail' => 'sample12.jpg',
                'description' => 'これはサンプルカリキュラム12の説明です。',
                'video_url' => 'https://example.com/video12',
                'alway_delivery_flg' => 1,
                'grade_id' => 13, // 高校3年生
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}