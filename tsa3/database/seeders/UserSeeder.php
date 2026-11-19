<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'username' => 'your-username',
            'full_name' => 'Your Full Name',
            'email' => 'you@example.com',
        ]);
    }
}
