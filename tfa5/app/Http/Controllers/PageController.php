<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * TFA5 landing page.
     */
    public function landing()
    {
        return view('landing');
    }

    /**
     * TFA5 about page.
     */
    public function about()
    {
        return view('about');
    }
}
