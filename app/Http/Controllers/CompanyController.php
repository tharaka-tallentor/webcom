<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\OTPRequest;
use App\Http\Requests\SocialRequest;
use App\Models\Approve;
use App\Models\Company;
use App\Models\Connection;
use App\Models\ConnectionList;
use App\Models\Country;
use App\Models\Industry;
use App\Models\PersonInCharge;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class CompanyController extends Controller
{
    public function root()
    {
        return redirect()->route('control_panel.register.view');
    }

    public function index(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $id = Connection::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->first();
            $list = ConnectionList::where('connection_fk_id', $id->connection_id)->select('connection_list.company_fk_id')->get();
            $data = array();
            foreach ($list as $key => $number) {
                $data[] = $number->company_fk_id;
            }
            $connections = Connection::join('company', 'company.company_id', '=', 'connection.company_fk_id')
                ->where('company_fk_id', '!=', $data)
                ->where('company_fk_id', '!=', $request->session()->get('company_user.company.company_id'))
                ->inRandomOrder()
                ->limit(20)
                ->select('company.*')
                ->get();

            $post_news = array();

            $post = Post::whereIn('company_fk_id', $data)
                ->select('post.*')
                ->inRandomOrder()
                ->limit(50)
                ->get();

            foreach ($post as $key => $item) {
                $pic = PersonInCharge::where('pic_id', $item->pic_fk_id)->first();
                $comp = Company::where('company_id', $item->company_fk_id)->first();
                $post_news[] = array(
                    "id" => $item->post_id,
                    "content" => $item->content,
                    "date" => $item->post_date,
                    "publish_by" => $pic->name,
                    "company" => $comp->name
                );
            }
            $news_que = $this->paginate($post_news);

            $reaction = Reaction::all();

            return view('app', compact('connections', 'news_que', 'reaction'));
        } else {
            return redirect()->route('control_panel.login');
        }
    }

    public function login(Request $request)
    {
        return view('company.user.login');
    }

    public function temp_login_view(Request $request)
    {
        return view('company.login');
    }

    public function company_register_view()
    {
        $country = Country::get();
        $industry = Industry::get();
        return view('company.register', compact('country', 'industry'));
    }

    public function temp_login(Request $request)
    {
        if ($request->session()->has('temp_login')) {
            if (
                $company = Company::where('email', $request->session()->get('temp_login.email'))->first() and
                $request->session()->get('temp_login.otp') == $request->otp
            ) {
                $request->session()->forget('temp_login');
                $industry = Industry::where("industry_id", $company->industry_fk_id)->first();
                $data = ["company" => $company, "industry" => $industry];
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
        $company->registor_date = Carbon::now()->toDateTimeString();

        if ($request->ajax()) {
            if ($company->save()) {
                if (ConnectionController::create($company->id) and ApproveController::approvel($company->id)) {
                    $otp = random_int(0000, 9999);
                    $data = [
                        "email" => $request->email,
                        "otp" => $otp
                    ];
                    $request->session()->put('temp_login', $data);
                    MailController::sendSignupEmail($company->name, $company->email, $otp);
                    return response()->json(["status" => 200, "message" => 'Company registerd ...', 'route' => route('control_panel.login.view')]);
                } else {
                    $request->session()->flash('error', 'Connection error ...');
                    return response()->json(["status" => 500, "message" => 'Company connection faild ...', 'route' => route('control_panel.login.view')]);
                }
            } else {
                $request->session()->flash('error', 'Connection error ...');
                return response()->json(["status" => 500, "message" => 'Company registation faild ...', 'route' => route('control_panel.login.view')]);
            }
        } else {
            if ($company->save()) {
                if (ConnectionController::create($company->id) and  ApproveController::approvel($company->id)) {
                    $otp = random_int(0000, 9999);
                    $data = [
                        "email" => $request->email,
                        "otp" => $otp
                    ];
                    $request->session()->put('temp_login', $data);
                    MailController::sendSignupEmail($company->name, $company->email, $otp);
                    $request->session()->flash('success', 'Company registerd ...');
                    return redirect()->route('control_panel.login.view');
                } else {
                    $request->session()->flash('error', 'Connection error ...');
                    return redirect()->route('control_panel.login.view');
                }
            } else {
                $request->session()->flash('error', 'Company registation faild ...');
                return redirect()->route('control_panel.register.view');
            }
        }
    }

    public function resend_otp(Request $request)
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
            $social = Social::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->get();
            return view('company.profile', compact('country', 'industry', 'social'));
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

    public function add_social(SocialRequest $request)
    {
        $social = new Social();
        $social->social_media_name = $request->media_name;
        $social->link    = $request->media_link;
        $social->icon = "";
        $social->registor_date = Carbon::now()->toDateTimeString();
        $social->company_fk_id = $request->session()->get('company_user.company.company_id');

        if ($request->ajax()) {
            !$social->save() ? $res = ["status" => 500, "message" => "Listing faild ..."] : $res = ["status" => 200, "message" => "Listed ..."];
            return response()->json($res);
        } else {
            !$social->save() ?   $request->session()->flash('error', 'Listing faild ...') : $request->session()->flash('success', 'Listed ...');
            return redirect()->route('control_panel.profile.view');
        }
    }

    public function delete_social(Request $request)
    {
        if ($request->ajax()) {
            !Social::where('social_id', $request->id)->delete() ? $res = ["status" => 500, "message" => "Delete faild ..."] : $res = ["status" => 200, "message" => "Deleted ..."];
            return response()->json($res);
        } else {
            !Social::where('social_id', $request->id)->delete() ?   $request->session()->flash('error', 'Delete faild ...') : $request->session()->flash('success', 'Deleted ...');
            return redirect()->route('control_panel.profile.view');
        }
    }

    public function get_all_social(Request $request)
    {
        $social = Social::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->get();
        return response()->json($social);
    }

    public function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
