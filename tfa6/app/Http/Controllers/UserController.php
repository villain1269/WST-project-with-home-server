<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * TFA6: records are now retrieved through the User Eloquent
     * model instead of the static array used in TFA5.
     */
    public function index()
    {
        $users = User::orderBy('username')->get();

        return view('users', ['users' => $users]);
    }
}
