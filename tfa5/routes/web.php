<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — TFA5
|--------------------------------------------------------------------------
| Four pages: landing (/), about (/about), customers (/customers)
| and users (/users).
| Routes are kept clean (no /tfa5 prefix here) — Caddy's handle_path
| strips the prefix before the request reaches Laravel, and
| AppServiceProvider re-attaches it when generating URLs.
| Named routes are used everywhere so links survive refactoring.
*/

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
