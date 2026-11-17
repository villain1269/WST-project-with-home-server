<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * TFA5 temporary data source: a static PHP array of sample
     * users (at least 5 records), passed to the Blade view and
     * looped with @foreach.
     */
    public function index()
    {
        $users = [
            ['username' => 'jdelacruz', 'full_name' => 'Juan Dela Cruz'],
            ['username' => 'msantos', 'full_name' => 'Maria Santos'],
            ['username' => 'preyes', 'full_name' => 'Pedro Reyes'],
            ['username' => 'alim', 'full_name' => 'Ana Lim'],
            ['username' => 'jramos', 'full_name' => 'Jose Ramos'],
        ];

        return view('users', ['users' => $users]);
    }
}
