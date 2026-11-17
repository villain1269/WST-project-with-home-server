<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * TFA6 landing page.
     */
    public function landing()
    {
        return view('landing');
    }

    /**
     * TFA6 about page.
     */
    public function about()
    {
        return view('about');
    }
}
