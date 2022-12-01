<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        !Auth::attempt(['email' => $request->email, 'password' => $request->password]) ? $res = ["status" => 500, "message" => "Login Faild ..."] : $res = ["status" => 200, "message" => "Login success ..."];
        return response()->json($res);
    }

    public function registor(RegisterRequest $request)
    {
        $registor = new User();
        $registor->first_name = $request->first_name;
        $registor->last_name = $request->last_name;
        $registor->user_uuid = Str::uuid();
        $registor->email = $request->email;
        $registor->authorize_by = "";
        $registor->designation = $request->designation;
        $registor->mobile = $request->mobile;
        $registor->password = Hash::make($request->password);
        $registor->registor_date = Carbon::now()->toDateTimeString();

        !$registor->save() ? $res = ["status" => 500, "message" => "Registation faild ..."] : $res = ["status" => 200, "message" => "Registation Success ..."];
        return response()->json($res);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(["status" => 200, "message" => "Logout ..."]);
    }
}
