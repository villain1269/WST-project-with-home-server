<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['username' => 'jdelacruz', 'full_name' => 'Juan Dela Cruz'],
            ['username' => 'msantos', 'full_name' => 'Maria Santos'],
            ['username' => 'preyes', 'full_name' => 'Pedro Reyes'],
            ['username' => 'alim', 'full_name' => 'Ana Lim'],
            ['username' => 'jramos', 'full_name' => 'Jose Ramos'],
        ];

        // avatar stays NULL until one is uploaded through the edit form;
        // the listing then shows the placeholder image instead.
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
