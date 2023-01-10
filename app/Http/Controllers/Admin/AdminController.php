<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin\Role;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('admin.system_admins');
    }

    public function updateAdminView(Request $request)
    {
        $role = Role::where('role_id', auth()->user()->role_fk_id)->first();
        if ($role->role == "super admin" || $role->role == "Super admin" || $role->$role == "SUPER ADMIN") {
            $user = User::where('user_id', $request->id)->first();
            return view('admin.edit_admin', compact('user'));
        } else {
            $request->session()->flash("error", "This privilage SUPER ADMIN only");
            return redirect()->route('admin.in.system');
        }
    }

    public function getAllAdmins(Request $request)
    {
        $admins = User::join('role', 'role.role_id', 'users.role_fk_id')->select('users.*', 'role.role')->get();
        return Datatables::of($admins)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function deleteAdmin(Request $request)
    {
        $role = Role::where('role', 'super admin')->first();
        if ($request->ajax()) {
            if (auth()->user()->role_fk_id == $role->role_id) {
                if (auth()->user()->user_id != $request->id) {
                    !User::where('user_id', $request->id)->delete() ? $res = ["status" => 500, "message" => "Record delete faild ..."] :
                        $res = ["status" => 200, "message" => "Recored deleted ..."];
                    return response()->json($res);
                } else {
                    return response()->json(["status" => 500, "message" => "Can't delete your data ..."]);
                }
            } else {
                return response()->json(["status" => 500, "message" => "This action ony process SUPER ADMIN ..."]);
            }
        } else {
            if (auth()->user()->role_fk_id == $role->role_id) {
                if (auth()->user()->user_id != $request->id) {
                    if (User::where('user_id', $request->id)->delete()) {
                        $request->session()->flash("success", "Recored deleted ...");
                        return redirect()->route('admin.all');
                    } else {
                        $request->session()->flash("error", "Record delete faild ...");
                        return redirect()->route('admin.all');
                    }
                } else {
                    $request->session()->flash("error", "Can't delete your data ...");
                    return redirect()->route('admin.all');
                }
            } else {
                $request->session()->flash("error", "This action ony process SUPER ADMIN ...");
                return redirect()->route('admin.all');
            }
        }
    }

    public function updateAdmin(UpdateAdminRequest $request)
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
                'password' => ['min:5']
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
            !User::where('user_id', $request->id)->update($data) ? $res = ["status" => 500, "message" => "Update faild ..."] :
                $res = ["status" => 200, "message" => "updated ..."];
            return response()->json($res);
        } else {
            if (User::where('user_id', $request->id)->update($data)) {
                $request->session()->flash('success', 'Updated ...');
                return redirect()->route('admin.in.system');
            } else {
                $request->session()->flash('error', 'Update faild ...');
                return redirect()->route('admin.in.system');
            }
        }
    }
}
