<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — TSA3 (Tasks for Today Management System, Laravel)
|--------------------------------------------------------------------------
| Four pages: Welcome (today's tasks only), Task List (all, by date),
| Profile (the single user record), and About.
|
| No /tsa3 prefix here: Caddy's handle_path strips the prefix before
| proxying and AppServiceProvider re-attaches it in generated URLs.
*/

Route::get('/', [TaskController::class, 'welcome'])->name('landing');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/about', [PageController::class, 'about'])->name('about');
