<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\RegisterControllrt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('admin.')->group(function () {
    Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/admin/login/view', [LoginController::class, 'index'])->name('login.view');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.view')->middleware('auth');

    Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
    Route::post('/admin/register', [RegisterController::class, 'register'])->name('register');
});
