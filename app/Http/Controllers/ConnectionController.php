<?php

namespace App\Http\Controllers;

use App\Models\Approve;
use App\Models\ApproveList;
use App\Models\Company;
use App\Models\Connection;
use App\Models\ConnectionList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{
    public function create($company_id)
    {
        $connection = new Connection();
        $connection->company_fk_id = $company_id;
        $connection->connection_date = Carbon::now()->toDateString();

        if ($connection->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function add_connection(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $id = Approve::where('company_fk_id', $request->id)->first();
            $connection = Connection::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->first();
            $approve_list = new ApproveList();
            $approve_list->approve_fk_id = $id->approve_id;
            $approve_list->connection_fk_id = $connection->connection_id;
            $approve_list->approve_list_date = Carbon::now()->toDateString();
            if ($request->ajax()) {
                !$approve_list ? $res = ["status" => 500, "message" => "Can't send request ..."] : $res = ["status" => 200, "message" => "Requested ..."];
                return response()->json($res);
            } else {
                if ($approve_list->save()) {
                    $request->session()->flash("success", "Requested ...");
                    return redirect()->route("control_panel.dashboard");
                } else {
                    $request->session()->flash("error", "Can't send request ...");
                    return redirect()->route("control_panel.dashboard");
                }
            }
        } else {
            return abort(404);
        }
    }
    public function approve(Request $request)
    {
        if ($this->token_match($request->token)) {
            if ($request->session()->has('company_user')) {

                $con1 = Connection::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->first();
                $conn2 = Connection::where('company_fk_id', $request->id)->first();
                $data1 = [
                    "connection_fk_id" => $con1->connection_id,
                    "company_fk_id" => $request->id,
                    "approve_status" => true,
                    "listed_date" => Carbon::now()->toDateString(),
                    "created_at" => Carbon::now()->toDateString(),
                    "updated_at" => Carbon::now()->toDateString()
                ];
                $data2 = [
                    "connection_fk_id" => $conn2->connection_id,
                    "company_fk_id" => $request->session()->get('company_user.company.company_id'),
                    "approve_status" => true,
                    "listed_date" => Carbon::now()->toDateString(),
                    "created_at" => Carbon::now()->toDateString(),
                    "updated_at" => Carbon::now()->toDateString()
                ];

                ApproveList::where('approve_list_id', $request->list_id)->delete();
                if ($request->ajax()) {
                    !DB::table('connection_list')->insert([$data1, $data2]) ?  $res = ["status" => 500, "message" => "Approve faild ..."] : $res = ["status" => 200, "message" => "Approved ..."];
                    return response()->json($res);
                } else {
                    if (DB::table('connection_list')->insert([$data1, $data2])) {
                        $request->session()->flash('success', 'Connection approve ...');
                        return redirect()->route('control_panel.profile.view');
                    } else {
                        $request->session()->flash('error', 'Approve faild ...');
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

    public function approveList(Request $request)
    {
        if ($request->session()->has('company_user')) {
            if ($request->ajax()) {
                $list = Approve::join('approve_list', 'approve_list.approve_fk_id', '=', 'approve.approve_id')
                    ->where('company_fk_id', $request->session()->get('company_user.company.company_id'))
                    ->select('approve_list.*')
                    ->get();
                $ids = array();
                foreach ($list as $key => $data) {
                    $connection = Connection::join('company', 'company.company_id', '=', 'connection.company_fk_id')
                        ->where('connection_id', $data->connection_fk_id)
                        ->get();
                    $ids[] = [
                        "approve_list_id" => $data->approve_list_id,
                        "connection" => $connection
                    ];
                }
                $element = "";
                foreach ($ids as $key => $data) {
                    foreach ($data['connection'] as $conn) {
                        $element .= "<div class='col-12 col-md-12'>" .
                            "<div class='row'>" .
                            "<div class='col-4 col-md-4'>" .
                            "<img class='img img-thumbnail' loading='lazy' src='" . asset($conn->company_avatar) . "' />" .
                            "</div>" .
                            "<div class='col-4 col-md-4'>" .
                            "<div class='row'>" .
                            "<div class='col-12 col-md-12'>" .
                            "<h3>" . $conn->name . "</h3>" .
                            "</div>" .
                            "<div class='col-12 col-md-12'>" .
                            "<p>I wan't be your connection</p>" .
                            "</div>" .
                            "</div>" .
                            "</div>" .
                            "<div class='col-4 col-md-4'>" .
                            "<a class='btn btn-success m-2' href='" . url('/control/approve/connection/') . '/' . csrf_token() . '/' . $conn->company_id . '/' . $data['approve_list_id'] . "'>Approve</a>" .
                            "<a class='btn btn-danger m-2' href='" . url('/control/delete/approvel/') . '/' . csrf_token() . '/' . $data['approve_list_id'] . "'>Reject</a>" .
                            "</div>" .
                            "</div>";
                        "</div>";
                    }
                }
                return response()->json(["status" => 200, "message" => "List fetched ...", "data" => $element]);
            } else {
                $list = Approve::join('approve_list', 'approve_list.approve_fk_id', '=', 'approve.approve_id')
                    ->where('company_fk_id', $request->session()->get('company_user.company.company_id'))
                    ->select('approve_list.*')
                    ->get();
                $ids = array();
                foreach ($list as $key => $data) {
                    $connection = Connection::join('company', 'company.company_id', '=', 'connection.company_fk_id')
                        ->where('connection_id', $data->connection_fk_id)
                        ->get();
                    $ids[] = [
                        "approve_list_id" => $data->approve_list_id,
                        "connection" => $connection
                    ];
                }
                $element = "";
                foreach ($ids as $key => $data) {
                    foreach ($data['connection'] as $conn) {
                        $element .= "<div class='col-12 col-md-12'>" .
                            "<div class='row'>" .
                            "<div class='col-4 col-md-4'>" .
                            "<img class='img img-thumbnail' loading='lazy' src='" . asset($conn->company_avatar) . "' />" .
                            "</div>" .
                            "<div class='col-4 col-md-4'>" .
                            "<div class='row'>" .
                            "<div class='col-12 col-md-12'>" .
                            "<h3>" . $conn->name . "</h3>" .
                            "</div>" .
                            "<div class='col-12 col-md-12'>" .
                            "<p>I wan't be your connection</p>" .
                            "</div>" .
                            "</div>" .
                            "</div>" .
                            "<div class='col-12 col-md-12'>" .
                            "<a class='btn btn-success m-2' href='" . url('/control/approve/connection/') . '/' . csrf_token() . '/' . $conn->company_id . '/' . $data['approve_list_id'] . "'>Approve</a>" .
                            "<a class='btn btn-danger m-2' href='" . url('/control/delete/approvel/') . '/' . csrf_token() . '/' . $data['approve_list_id'] . "'>Reject</a>" .
                            "</div>" .
                            "</div>";
                        "</div>";
                    }
                }
                return $element;
            }
        } else {
            return abort(404);
        }
    }

    public function connectionList(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $conn = Connection::where('company_fk_id', $request->session()->get('company_user.company.company_id'))
                ->first();
            $list = ConnectionList::where('connection_fk_id', $conn->connection_id)->get();

            $element = "";
            foreach ($list as $key => $data) {
                $comp = Company::where('company_id', $data->company_fk_id)->first();
                $element .= "<div class='col-12 col-md-12'>" .
                    "<div class='row'>" .
                    "<div class='col-4 col-md-4'>" .
                    "<img class='img img-thumbnail' src='" . asset($comp->company_avatar) . "' loading='lazy' />" .
                    "</div>" .
                    "<div class='col-4 col-md-4'>" .
                    "<h3>" . $comp->name . "</h3>" .
                    "</div>" .
                    "<div class='col-4' col-md-4>" .
                    "<a class='btn btn-danger' href='" . url('/control/delete/connection/') . '/' . csrf_token() . '/' . $data->connection_list_id . "'>Remove</a>" .
                    "</div>" .
                    "</div>" .
                    "</div>";
            }
            if ($request->ajax()) {
                return response()->json(["status" => 200, "message" => "Connection feched ...", "list" => $element]);
            } else {
                return $element;
            }
        } else {
            return abort(404);
        }
    }

    public function rejectConnection(Request $request)
    {
        if ($this->token_match($request->token)) {
            if ($request->session()->has('company_user')) {
                if ($request->ajax()) {
                    !ConnectionList::where('connection_list_id', $request->id)->delete() ? $res = ["status" => 500, "message" => "Can't remove ..."] : $res = ["status" => 200, "message" => "Removed ..."];
                    return response()->json($res);
                } else {
                    if (ConnectionList::where('connection_list_id', $request->id)->delete()) {
                        $request->session()->flash('success', 'Removed ...');
                        return redirect()->route("control_panel.profile.view");
                    } else {
                        $request->session()->flash('error', "Can't removed ...");
                        return redirect()->route("control_panel.profile.view");
                    }
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    public function token_match($token)
    {
        if (csrf_token() == $token) {
            return true;
        } else {
            return false;
        }
    }
}
