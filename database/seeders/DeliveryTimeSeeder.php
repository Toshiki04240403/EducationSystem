<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_times')->insert([
            [
                'curriculums_id' => 4,
                'delivery_from' => '2025-01-01 09:00:00',
                'delivery_to' => '2026-01-01 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 5,
                'delivery_from' => '2025-01-02 09:00:00',
                'delivery_to' => '2026-01-02 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 6,
                'delivery_from' => '2025-01-03 09:00:00',
                'delivery_to' => '2026-01-03 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 7,
                'delivery_from' => '2025-01-04 09:00:00',
                'delivery_to' => '2026-01-04 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 8,
                'delivery_from' => '2025-01-05 09:00:00',
                'delivery_to' => '2026-01-05 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 9,
                'delivery_from' => '2025-01-06 09:00:00',
                'delivery_to' => '2026-01-06 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 10,
                'delivery_from' => '2025-01-07 09:00:00',
                'delivery_to' => '2026-01-07 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 11,
                'delivery_from' => '2025-01-08 09:00:00',
                'delivery_to' => '2026-01-08 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 12,
                'delivery_from' => '2025-01-09 09:00:00',
                'delivery_to' => '2026-01-09 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 13,
                'delivery_from' => '2025-01-10 09:00:00',
                'delivery_to' => '2026-01-10 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 14,
                'delivery_from' => '2025-01-11 09:00:00',
                'delivery_to' => '2026-01-11 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'curriculums_id' => 15,
                'delivery_from' => '2025-01-12 09:00:00',
                'delivery_to' => '2026-01-12 10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}