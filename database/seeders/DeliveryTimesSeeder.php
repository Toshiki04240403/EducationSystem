<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DeliveryTimesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); // Fakerインスタンスを作成

        $curriculums = DB::table('curriculums')->pluck('id'); // 全てのカリキュラムIDを取得

        // 各カリキュラムに対して配信日時を挿入
        foreach ($curriculums as $curriculumId) {
            for ($i = 0; $i < 3; $i++) { // 各カリキュラムに3つの配信日時を作成
                $deliveryFrom = Carbon::now()->addDays($i * 7); // 現在から7日間隔で配信開始日時
                $deliveryTo = $deliveryFrom->copy()->addHours(1); // 開始日時の1時間後を終了日時に設定

                DB::table('delivery_times')->insert([
                    'curriculums_id' => $curriculumId, // カリキュラムID
                    'delivery_from' => $deliveryFrom,
                    'delivery_to'   => $deliveryTo,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);
            }
        }
    }
}
