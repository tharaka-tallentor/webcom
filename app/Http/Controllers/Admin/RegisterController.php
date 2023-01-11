<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Admin\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
    }

    public function register(RegisterRequest $request)
    {
        $find_role = Role::where('role', $request->role)->select('role.role_id')->first();
        $user = new User();
        $user->user_uuid = Str::uuid();
        $user->first_name = $request->f_name;
        $user->last_name = $request->l_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->authorize_by = $request->authorized;
        $user->designation = "webcom_admin";
        $user->mobile = $request->mobile;
        $user->user_avatar = "/upload/admin/temp/avatar/avatar-1577909_1280.jpg";
        $user->role_fk_id = $find_role->role_id;
        $user->registor_date = Carbon::now()->toDateString();

        if ($request->ajax()) {
            !$user->save() ? $res = ["status" => 500, "message" => "Registerd ..."] :
                $res = ["status" => 200, "message" => "Registation faild ..."];
            return response()->json($res);
        } else {
            if ($user->save()) {
                return "registerd ...";
            } else {
                return "registation faild ...";
            }
        }
    }
}
