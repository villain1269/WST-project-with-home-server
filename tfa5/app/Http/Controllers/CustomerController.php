<?php

namespace App\Http\Controllers;

class CustomerController extends Controller
{
    /**
     * TFA5 temporary data source: a static PHP array of sample
     * customers (at least 5 records), passed to the Blade view
     * and looped with @foreach.
     */
    public function index()
    {
        $customers = [
            ['full_name' => 'Juan Dela Cruz', 'email' => 'juan.delacruz@example.com', 'phone' => '0917-123-4567'],
            ['full_name' => 'Maria Santos', 'email' => 'maria.santos@example.com', 'phone' => '0918-234-5678'],
            ['full_name' => 'Pedro Reyes', 'email' => 'pedro.reyes@example.com', 'phone' => '0919-345-6789'],
            ['full_name' => 'Ana Lim', 'email' => 'ana.lim@example.com', 'phone' => '0920-456-7890'],
            ['full_name' => 'Jose Ramos', 'email' => 'jose.ramos@example.com', 'phone' => '0921-567-8901'],
        ];

        return view('customers', ['customers' => $customers]);
    }
}
