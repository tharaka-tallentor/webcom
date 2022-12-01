<?php

use App\Http\Controllers\PersonInChanrgeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});


Route::name('control_panel.')->group(function () {
    //User Routes
    Route::post('/control/login/user', [PersonInChanrgeController::class, 'login'])->name('login');
    Route::post('/control/registor/user', [PersonInChanrgeController::class, 'registor'])->name('registor');
    Route::get('/control/logout/user', [PersonInChanrgeController::class, 'logout'])->name('logout');
});
