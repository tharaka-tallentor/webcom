<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegesterRequest;
use App\Models\Company;
use App\Models\PersonInCharge;
use App\Models\Social;
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
                // $company = Company::join('social', 'social.company_fk_id', '=', 'company.company_id')->where('company_id', $pic->company_fk_id)->get(['company.*', 'social.social_media_name']);
                $company = Company::where('company_id', $pic->company_fk_id)->first();
                $social = Social::where('company_fk_id', $company->company_id)->get();
                $data = ["user" => $pic, "company" => $company, "social" => $social];
                $request->session()->put('company_user', $data);
                return response()->json(["status" => 200, "message" => "User Logged ...", "route" => route('control_panel.dashboard')]);
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
        $person_in_charge->position = $request->position;
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
            return response()->json(["status" => 200, "message" => "Logout ...", "route" => route('control_panel.login')]);
        } else {
            return response()->json(["status" => 500, "message" => "User session not found..."]);
        }
    }

    public function all_company_pic(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $pic = PersonInCharge::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->orderBy('registor_date', 'desc')->get();
            return response()->json(["status" => 200, "message" => "Data fetched ...", "data" => $pic]);
        } else {
            return response()->json(["status" => 500, "message" => "Authorize url pleace login ..."]);
        }
    }
}
