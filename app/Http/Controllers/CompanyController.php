<?php

namespace App\Http\Controllers;

use App\Models\PersonInCharge;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('company_user')) {
            return view('app');
        } else {
            return redirect()->route('control_panel.login');
        }
    }

    public function login(Request $request)
    {
        return view('company.user.login');
    }

    public function person_in_charge_view(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $pic = PersonInCharge::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->orderBy('registor_date', 'desc')->get();
            return view('company.user.person_in_charge', compact('pic'));
        } else {
            return redirect()->route('control_panel.login');
        }
    }
}
