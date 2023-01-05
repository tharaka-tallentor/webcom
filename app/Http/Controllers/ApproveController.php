<?php

namespace App\Http\Controllers;

use App\Models\Approve;
use App\Models\ApproveList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApproveController extends Controller
{
    public static function approvel($company_id)
    {
        $approuve = new Approve();
        $approuve->company_fk_id = $company_id;
        $approuve->approuve_date = Carbon::now()->toDateString();

        if ($approuve->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function rejectApprovel(Request $request)
    {
        if ($request->token == csrf_token()) {
            if ($request->session()->has('company_user')) {
                if ($request->ajax()) {
                    !ApproveList::where('connection_fk_id', $request->id)->delete() ? $res = ["status" => 500, "message" => "Rejection faild ..."] : $res = ["status" => 200, "message" => "Connection rejected ..."];
                    return response()->json($res);
                } else {
                    if (ApproveList::where('connection_fk_id', $request->id)->delete()) {
                        $request->session()->flash('Connection rejected ...');
                        return redirect()->route('control_panel.profile.view');
                    } else {
                        $request->session()->flash('Rejection faild ...');
                        return redirect()->route('control_panel.profile.view');
                    }
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }
}
