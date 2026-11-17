<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * TFA7 seeder: at least 5 customers and 5 users.
     */
    public function run(): void
    {
        $this->call([
            CustomerSeeder::class,
            UserSeeder::class,
        ]);
    }
}
