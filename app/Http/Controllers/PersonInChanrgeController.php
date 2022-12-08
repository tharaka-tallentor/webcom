<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegesterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Company;
use App\Models\Industry;
use App\Models\PersonInCharge;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DataTables;


class PersonInChanrgeController extends Controller
{
    public function login(UserLoginRequest $request)
    {

        if ($pic = PersonInCharge::where('email', $request->email)->first()) {
            if (Hash::check($request->password, $pic->password)) {
                // $company = Company::join('social', 'social.company_fk_id', '=', 'company.company_id')->where('company_id', $pic->company_fk_id)->get(['company.*', 'social.social_media_name']);
                if ($request->session()->has('company_user')) {
                    $request->session()->forget('company_user');
                    $company = Company::where('company_id', $pic->company_fk_id)->first();
                    $social = Social::where('company_fk_id', $company->company_id)->get();
                    $industry = Industry::where("industry_id", $company->industry_fk_id)->first();
                    $data = ["company" => $company, "social" => $social, "industry" => $industry];
                    $request->session()->put('company_user', $data);
                } else {
                    $company = Company::where('company_id', $pic->company_fk_id)->first();
                    $social = Social::where('company_fk_id', $company->company_id)->get();
                    $industry = Industry::where("industry_id", $company->industry_fk_id)->first();
                    $data = ["company" => $company, "social" => $social, "industry" => $industry];
                    $request->session()->put('company_user', $data);
                }
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
            $pic = PersonInCharge::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->where('status', 1)->orderBy('registor_date', 'desc')->get();
            // return response()->json(["status" => 200, "message" => "Data fetched ...", "data" => $pic]);

            return  Datatables::of($pic)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return response()->json(["status" => 500, "message" => "Authorize url pleace login ..."]);
        }
    }

    public function delete_pic(Request $request)
    {
        if ($request->session()->has('company_user')) {
            if (PersonInCharge::where("pic_id", $request->id)->delete()) {
                return response()->json(["status" => 200, "message" => "Recored deleted ..."]);
            } else {
                return response()->json(["status" => 500, "message" => "Recored delete faild ..."]);
            }
        } else {
            return response()->json(["status" => 500, "message" => "Authorize url pleace login ..."]);
        }
    }

    public function update_pic(UserUpdateRequest $request)
    {
        if ($request->session()->has('company_user')) {
            $data = "";
            if ($request->password != null) {
                $data = [
                    "email" => $request->email,
                    "password" => $request->password,
                    "mobile" => $request->mobile,
                    "position" => $request->position
                ];
            } else {
                $data = [
                    "email" => $request->email,
                    "mobile" => $request->mobile,
                    "position" => $request->position
                ];
            }
            if (PersonInCharge::where("pic_id", $request->id)->update($data)) {
                return response()->json(["status" => 200, "message" => "Recored Updated ...", "route" => route('control_panel.person_in_charge')]);
            } else {
                return response()->json(["status" => 500, "message" => "Recored Update faild ..."]);
            }
        } else {
            return response()->json(["status" => 500, "message" => "Authorize url pleace login ..."]);
        }
    }
}
