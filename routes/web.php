<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PersonInChanrgeController;
use App\Models\PersonInCharge;
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

Route::name('control_panel.')->group(function () {
    //User Routes
    Route::get('/control/dashboard', [CompanyController::class, 'index'])->name('dashboard');
    Route::get('/control/login', [CompanyController::class, 'login'])->name('login');
    Route::get('/control/person-in-charge', [CompanyController::class, 'person_in_charge_view'])->name('person_in_charge');
    Route::post('/control/login/user', [PersonInChanrgeController::class, 'login'])->name('auth');
    Route::post('/control/registor/user', [PersonInChanrgeController::class, 'registor'])->name('registor');
    Route::get('/control/logout/user', [PersonInChanrgeController::class, 'logout'])->name('logout');
    Route::get('/control/all/person-in-charge', [PersonInChanrgeController::class, 'all_company_pic'])->name('all.pic');
});
