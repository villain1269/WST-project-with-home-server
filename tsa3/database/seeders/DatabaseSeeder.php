<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * TSA3 seeder: 8 tasks across 3 different dates (including today)
     * and exactly 1 user record, per the assessment requirements.
     */
    public function run(): void
    {
        $this->call([
            TaskSeeder::class,
            UserSeeder::class,
        ]);
    }
}
