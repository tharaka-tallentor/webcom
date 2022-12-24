<?php

namespace App\Http\Controllers;

use App\Models\Approve;
use App\Models\ApproveList;
use App\Models\Connection;
use App\Models\ConnectionList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
    }
    public function approve(Request $request)
    {
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
                            "<a class='btn btn-success m-2' href='javascript:void(0)'>Approve</a>" .
                            "<a class='btn btn-danger m-2' href='javascript:void(0)'>Reject</a>" .
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
                            "<a class='btn btn-success m-2' href='javascript:void(0)'>Approve</a>" .
                            "<a class='btn btn-danger m-2' href='javascript:void(0)'>Reject</a>" .
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
        if ($request->ajax()) {
        } else {
        }
    }
}
