<?php

use App\Http\Controllers\Admin\ComapnyUserController;
use App\Http\Controllers\Admin\CompanyController;
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
    //GET Routes
    Route::get('/admin/logout', [LoginController::class, 'logout'])
        ->name('logout');
    Route::get('/admin/login/view', [LoginController::class, 'index'])
        ->name('login.view');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.view')
        ->middleware('auth');
    Route::get('/admin/system/companys', [CompanyController::class, 'allCompanys'])
        ->name('all.companys')
        ->middleware('auth');
    Route::get('/admin/companys', [CompanyController::class, 'index'])
        ->name('company.view')
        ->middleware('auth');
    Route::get('/admin/company/users', [ComapnyUserController::class, 'index'])
        ->name('company.user.view')
        ->middleware('auth');
    Route::get('/admin/company/user/{id}/list', [ComapnyUserController::class, 'companyUsers'])
        ->name('company.user.list')
        ->middleware('auth');

    //POST Routes
    Route::post('/admin/login', [LoginController::class, 'login'])
        ->name('login');
    Route::post('/admin/register', [RegisterController::class, 'register'])
        ->name('register');

    //DELETE Routes
    Route::delete('/admin/company/delete', [CompanyController::class, 'delete'])
        ->name('company.delete')
        ->middleware('auth');
    Route::delete('/admin/company/user/delete', [ComapnyUserController::class, 'deleteCompanyUser'])
        ->name('company.user.delete')
        ->middleware('auth');
});
