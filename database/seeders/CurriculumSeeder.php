<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CurriculumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Fakerインスタンスを作成

        $grades = DB::table('grades')->pluck('id'); // 全ての学年IDを取得

        // 各学年ごとにカリキュラムを挿入
        foreach ($grades as $gradeId) {
            DB::table('curriculums')->insert([
                'title' => $faker->sentence(3), // ランダムなタイトル
                'thumbnail' => 'default-thumbnail.jpg', // サムネイルのデフォルト画像名
                'description' => $faker->paragraph(), // ランダムな概要
                'video_url' => $faker->url(), // ランダムな動画URL
                'alway_delivery_flg' => $faker->boolean(), // ランダムな公開フラグ
                'grade_id' => $gradeId, // 学年ID
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
