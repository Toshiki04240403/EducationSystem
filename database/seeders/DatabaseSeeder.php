<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CurriculumSeeder::class,
            DeliveryTimesSeeder::class, // DeliveryTimeSeederを登録
        ]);
    }
}
