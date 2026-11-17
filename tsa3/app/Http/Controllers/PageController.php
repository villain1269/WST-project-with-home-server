<?php

namespace App\Http\Controllers;

use App\Models\User;

class PageController extends Controller
{
    /**
     * Profile page: displays the single seeded user record.
     */
    public function profile()
    {
        return view('profile', [
            'user' => User::first(),
        ]);
    }

    /**
     * About page: static page identifying the developer.
     */
    public function about()
    {
        return view('about');
    }
}
