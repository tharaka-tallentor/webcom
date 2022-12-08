<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\OTPRequest;
use App\Models\Company;
use App\Models\Country;
use App\Models\Industry;
use App\Models\PersonInCharge;
use App\Models\Social;
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

    public function temp_login(Request $request)
    {
        if ($request->session()->has('temp_login')) {
            if (
                $company = Company::where('email', $request->session()->get('temp_login.email'))->first() and
                $request->session()->get('temp_login.otp') == $request->otp
            ) {
                $request->session()->forget('temp_login');
                $social = Social::where('company_fk_id', $company->company_id)->get();
                $industry = Industry::where("industry_id", $company->industry_fk_id)->first();
                $data = ["company" => $company, "social" => $social, "industry" => $industry];
                $request->session()->put('company_user', $data);
                return response()->json(["status" => 200, "message" => "login success", "route" => route("control_panel.dashboard")]);
            } else {
                return response()->json(["status" => 500, "message" => "Wrong credential ..."]);
            }
        }
    }

    public function register(CompanyRequest $request)
    {
        $image_path = "";
        if ($request->avatar != null) {
            $imageName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('upload/profile/'), $imageName);
            $image_path = '/upload/profile/' . $imageName;
        }
        $company = new Company();
        $company->name = $request->name;
        $company->mobile = $request->mobile;
        $company->tel = $request->tel;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->web = $request->web;
        $company->company_avatar = $image_path;
        $company->fb_page = $request->fb_page;
        $company->industry_fk_id = $request->industry;
        $company->country_fk_id = $request->country;

        if ($company->save()) {
            $data = [
                "email" => $request->email,
                "otp" => random_int(0000, 9999)
            ];
            $request->session()->put('temp_login', $data);
            return response()->json(["status" => 200, "message" => "Company registation success ..."]);
        } else {
            return response()->json(["status" => 500, "message" => "Company registation faild ..."]);
        }
    }

    public function resend_otp(OTPRequest $request)
    {
        if ($request->session()->has('temp_login')) {
            $data = [
                "email" => $request->session()->get('temp_login.email'),
                "otp" => random_int(0000, 9999)
            ];
            $request->session()->forget('temp_login');
            $request->session()->put('temp_login', $data);
            return response()->json(["status" => 200, "message" => "OTP Sended ..."]);
        } else {
            return response()->json(["status" => 500, "message" => "Invalid session ..."]);
        }
    }

    public function profile(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $country = Country::all();
            $industry = Industry::all();
            return view('company.profile', compact('country', 'industry'));
        } else {
            return redirect()->route('control_panel.login');
        }
    }

    public function person_in_charge_view(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $pic = PersonInCharge::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->orderBy('registor_date', 'desc')->get();
            return view('company.user.person_in_charge');
        } else {
            return redirect()->route('control_panel.login');
        }
    }

    public function pic_edit_view(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $pic = PersonInCharge::where('pic_id', $request->id)->first();
            return view('company.user.edit_pic', compact('pic'));
        } else {
            return redirect()->route('control_panel.login');
        }
    }

    public function profile_update(CompanyRequest $request)
    {
        if ($request->session()->has('company_user')) {

            $image_path = "";
            if ($request->avatar != null) {
                $imageName = time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('upload/profile/'), $imageName);
                $image_path = '/upload/profile/' . $imageName;
            } else {
                $image_path = $request->path;
            }

            $data = [
                "name" => $request->name,
                "mobile" => $request->mobile,
                "tel" => $request->tel,
                "address" => $request->address,
                "email" => $request->email,
                "web" => $request->web,
                "company_avatar" => $image_path,
                "fb_page" => $request->fb_page,
                "industry_fk_id" => $request->industry,
                "country_fk_id" => $request->country
            ];


            if (Company::where('company_id', $request->session()
                ->get('company_user.company.company_id'))
                ->update($data)
            ) {
                $company = Company::where('company_id', $request->session()->get('company_user.company.company_id'))->first();
                $social = Social::where('company_fk_id', $company->company_id)->get();
                $industry = Industry::where("industry_id", $company->industry_fk_id)->first();
                $data = ["user" => $request->session()->get('company_user.user'), "company" => $company, "social" => $social, "industry" => $industry];
                $request->session()->forget('company_user');
                $request->session()->put('company_user', $data);
                $request->session()->flash('success', 'Profile Updated ....');
                return redirect()->route('control_panel.profile.view');
            } else {
                $request->session()->flash('error', 'Profile update faild ...');
                return redirect()->route('control_panel.profile.view');
            }
        } else {
            return response()->json(["status" => 500, "message" => "Authorize url pleace login ..."]);
        }
    }
}
