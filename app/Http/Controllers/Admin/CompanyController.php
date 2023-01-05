<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        return view('admin.system_company');
    }

    public function allCompanys(Request $request)
    {
        $companys = Company::orderBy('company.company_id', 'desc')->get();
        return Datatables::of($companys)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete(Request $request)
    {
        $image = Company::where('company_id', $request->id)->select('company.company_avatar')->first();

        if ($request->ajax()) {
            if (Company::where('company_id', $request->id)->delete()) {
                if (File::exists(public_path($image->company_avatar))) {
                    if (!File::delete(public_path($image->company_avatar))) {
                        return response()->json(["status" => 500, "message" => "Image path can't find for delete process ...!"]);
                        die();
                    } else {
                        return response()->json(["status" => 200, "message" => "Image deleted ...!"]);
                        die();
                    }
                }
            } else {
                return response()->json(["status" => 500, "message" => "Image can't delete."]);
            }
        } else {
            if (Company::where('company_id', $request->id)->delete()) {
                if (File::exists(public_path($image->company_avatar))) {
                    if (!File::delete(public_path($image->company_avatar))) {
                        $request->session()->flash("error", "Image path can't find for delete process ...!");
                        return redirect()->route('admin.company.view');
                    } else {
                        $request->session()->flash("success", "Image deleted ...!");
                        return redirect()->route('admin.company.view');
                    }
                }
            } else {
                $request->session()->flash("error", "Image can't delete.");
                return redirect()->route('admin.company.view');
            }
        }
    }
}
