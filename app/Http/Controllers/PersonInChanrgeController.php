<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegesterRequest;
use App\Models\PersonInCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class PersonInChanrgeController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if ($pic = PersonInCharge::where('email', $request->email)->first()) {
            if (Hash::check($request->password, $pic->password)) {
                $request->session()->put('company_user', $pic);
                return response()->json(["status" => 200, "message" => "User Logged ..."]);
            } else {
                return response()->json(["status" => 500, "message" => "Password incorrect ..."]);
            }
        } else {
            return response()->json(["status" => 500, "message" => "User not found ..."]);
        }
    }

    public function registor(UserRegesterRequest $request)
    {
        $person_in_charge = new PersonInCharge();
        $person_in_charge->pic_uuid = Str::uuid();
        $person_in_charge->email = $request->email;
        $person_in_charge->password = Hash::make($request->password);
        $person_in_charge->mobile = $request->mobile;
        $person_in_charge->authorize_by = "";
        $person_in_charge->designation = "";
        $person_in_charge->type = "pic_user";
        $person_in_charge->status = true;
        $person_in_charge->company_fk_id = 1;
        $person_in_charge->registor_date = Carbon::now()->toDateTimeString();

        !$person_in_charge->save() ? $res = ["status" => 500, "message" => "Registation faild ..."] : $res = ["status" => 200, "message" => "Registation success ..."];
        return response()->json($res);
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $request->session()->forget('company_user');
            return response()->json(["status" => 200, "message" => "Logout ..."]);
        } else {
            return response()->json(["status" => 500, "message" => "User session not found..."]);
        }
    }
}
