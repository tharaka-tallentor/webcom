<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('admin.profile');
    }

    public function updateProfile(ProfileRequest $request)
    {
        $data = "";

        if (empty($request->password)) {
            $data =  [
                "first_name" => $request->f_name,
                "last_name" => $request->l_name,
                "email" => $request->email,
                "mobile" => $request->mobile
            ];
        } else {
            $request->validate([
                'password' => ['min:5'],
                'confirm_password' => ['min:5', 'same:password']
            ]);

            $data = [
                "first_name" => $request->f_name,
                "last_name" => $request->l_name,
                "email" => $request->email,
                "mobile" => $request->mobile,
                "password" => Hash::make($request->password)
            ];
        }

        if ($request->ajax()) {
            !auth()->user()->update($data) ? $res = ["status" => 500, "message" => "Update Faild"] : $res = ["status" => 200, "message" => "Updated"];
            return response()->json($res);
        } else {
            if (auth()->user()->update($data)) {
                $request->session()->flash('success', 'Updated ...');
                return redirect()->route('admin.profile');
            } else {
                $request->session()->flash('error', 'Update Faild ...');
                return redirect()->route('admin.profile');
            }
        }
    }

    public function avatarUpload(Request $request)
    {
        $request->validate([
            "avatar" => ["required"]
        ]);

        $image_data_1 = explode(";", $request->avatar);
        $image_data_2 = explode(",", $image_data_1[1]);
        $data = base64_decode($image_data_2[1]);
        $image_name = "/upload/admin/avatar/" . time() . ".jpg";


        if (File::exists(public_path(auth()->user()->user_avatar))) {
            if (auth()->user()->user_avatar != "/upload/admin/temp/avatar/avatar-1577909_1280.jpg") {
                if (!File::delete(public_path(auth()->user()->user_avatar))) {
                    if ($request->ajax()) {
                        return response()->json(["status" => 500, "message" => "Avatar Delete Faild ...", "route" => route('admin.profile')]);
                    } else {
                        $request->session()->flash('error', 'Avatar Delete Faild ...');
                        return redirect()->route('admin.profile');
                    }
                }
            }
        }

        !file_put_contents(public_path($image_name), $data) ? $message = "Encode problem !" : $message = "Avatar upload success ...!";

        if ($request->ajax()) {
            !auth()->user()->update(["user_avatar" => $image_name]) ? $res = ["status" => 500, "message" => $message] :
                $res = ["status" => 200, "message" => $message];
            return response()->json($res);
        } else {
            if (auth()->user()->update(["user_avatar" => $image_name])) {
                $request->session()->flash('success', $message);
                return redirect()->route('admin.profile');
            } else {
                $request->session()->flash('error', $message);
                return redirect()->route('admin.profile');
            }
        }
    }
}
