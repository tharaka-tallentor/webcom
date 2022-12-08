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
    Route::get('/control/person-in-charge/edit/{id}', [CompanyController::class, 'pic_edit_view'])->name('pic.edit.view');
    Route::get('/control/profile', [CompanyController::class, 'profile'])->name('profile.view');
    Route::get('/control/logout/user', [PersonInChanrgeController::class, 'logout'])->name('logout');
    Route::get('/control/all/person-in-charge', [PersonInChanrgeController::class, 'all_company_pic'])->name('all.pic');
    Route::get('/control/resend/otp', [CompanyController::class, 'resend_otp'])->name('resend.otp');
    Route::get('/control/company/login/view', [CompanyController::class, 'temp_login_view'])->name('login.view');
    Route::get('/control/company/register/view', [CompanyController::class, 'company_register_view'])->name('register.view');

    Route::post('/control/person-in-charge/update', [PersonInChanrgeController::class, 'update_pic'])->name('pic.update');
    Route::post('/control/login/user', [PersonInChanrgeController::class, 'login'])->name('auth');
    Route::post('/control/registor/user', [PersonInChanrgeController::class, 'registor'])->name('registor');
    Route::post('/control/update/profile', [CompanyController::class, 'profile_update'])->name('profile.update');
    Route::post('/control/company/login', [CompanyController::class, 'temp_login'])->name('company.login');
    Route::post('/control/company/register', [CompanyController::class, 'register'])->name('company.register');

    Route::delete('/control/delete/person-in-charge/{id}', [PersonInChanrgeController::class, 'delete_pic'])->name('delete.pic');
});
