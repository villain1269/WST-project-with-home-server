<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — TFA6 (From Arrays to Eloquent)
|--------------------------------------------------------------------------
| Same four pages as TFA5, now fed by Eloquent models instead of static
| arrays. No /tfa6 prefix here: Caddy strips it before proxying and
| AppServiceProvider re-attaches it in generated URLs.
*/

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
