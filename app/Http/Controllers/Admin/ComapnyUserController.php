<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonInCharge;
use Illuminate\Http\Request;
use DataTables;

class ComapnyUserController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.system_users');
    }

    public function companyUsers(Request $request)
    {
        $pic = PersonInCharge::where('pic_id', $request->id)->orderBy('registor_date', 'desc')->get();
        return Datatables::of($pic)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function deleteCompanyUser(Request $request)
    {
        if ($request->ajax()) {
            !PersonInCharge::where('pic_id', $request->id)->delete() ? $res = ["status" => 500, "message" => "Delete faild ..."] :
                $res = ["status" => 200, "message" => "Deleted ..."];
            return response()->json($res);
        } else {
            if (PersonInCharge::where('pic_id', $request->id)->delete()) {
                $request->session()->flash('success', 'Deleted ...');
                return redirect()->route('admin.company.user.view');
            } else {
                $request->session()->flash('error', 'Delete faild ...');
                return redirect()->route('admin.company.user.view');
            }
        }
    }
}
