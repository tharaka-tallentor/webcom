<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\PersonInCharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $live_users = count(Session::all());
        $company = Company::count();
        $pic = PersonInCharge::count();
        $user = User::count();
        return view('admin.dashboard', compact('company', 'pic', 'user', 'live_users'));
    }
}
