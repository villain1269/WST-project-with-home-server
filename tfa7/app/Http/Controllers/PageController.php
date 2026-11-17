<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * TFA7 landing page.
     */
    public function landing()
    {
        return view('landing');
    }

    /**
     * TFA7 about page.
     */
    public function about()
    {
        return view('about');
    }
}
