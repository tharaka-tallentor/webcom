<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $data = [
            "email" => $request->email,
            "password" => $request->password
        ];

        if ($request->ajax()) {
            !Auth::attempt($data, $remember = true) ? $res = ["status" => 500, "message" => "Login faild ..."] :
                $res = ["status" => 200, "message" => "Login success ..."];
            return response()->json($res);
        } else {
            if (Auth::attempt($data, $remember = true)) {
                $request->session()->flash('success', 'Login success ...');
                return redirect()->route('admin.dashboard.view');
            } else {
                $request->session()->flash('error', 'Login faild ...');
                return redirect()->route('admin.login.view');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->ajax()) {
            return response()->json(["status" => 200, "message" => "Logout ...", "route" => route('admin.login.view')]);
        } else {
            $request->session()->flash('success', 'Logout ...');
            return redirect()->route('admin.login.view');
        }
    }
}
