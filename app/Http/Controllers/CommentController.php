<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Company;
use App\Models\PersonInCharge;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $comment = new Comment();
            $comment->comment = $request->post_comment;
            $comment->post_fk_id = $request->post_id;
            $comment->pic_fk_id = $request->session()->get('company_user.pic.pic_id');
            $comment->comment_date = Carbon::now()->toDateString();
            if ($request->ajax()) {
                !$comment->save() ? $res = ["status" => 500, "message" => "Comment faild ..."] :
                    $res = ["status" => 200, "message" => "Commented ..."];
                return response()->json($res);
            } else {
                if ($comment->save()) {
                    $request->session()->flash('success', 'Commented ...');
                    return redirect()->route('control_panel.dashboard');
                } else {
                    $request->session()->flash('error', 'Comment faild ...');
                    return redirect()->route('control_panel.dashboard');
                }
            }
        } else {
            return abort(404);
        }
    }

    public function getComment(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $all_comment = Comment::where('post_fk_id', $request->id)->get();

            if ($request->ajax()) {
                $list = "";
                foreach ($all_comment as $key => $item) {

                    $pic = PersonInCharge::join('company', 'company.company_id', '=', 'person_in_charge.company_fk_id')
                        ->where('pic_id', $item->pic_fk_id)
                        ->select('person_in_charge.name', 'person_in_charge.pic_id', 'company.name', 'company.company_avatar')
                        ->get();

                    // $btn_group = "";

                    // if ($request->session()->get('company_user.pic.pic_id') == $pic[0]->id) {
                    //     $btn_group .= "<a class='btn btn-danger' href='javascript:void(0)'>Delete<a>";
                    // }

                    $list .= "<div class='col-12 col-md-12'>" .
                        "<div class='row'>" .
                        "<div class='col-3 col-md-3'>" .
                        "<img class='img img-thumbnail' style='width: 50px; height: auto;' src='" . asset($pic[0]->company_avatar) . "' >" .
                        "<p>" . $pic[0]->name . "</p>" .
                        "</div>" .
                        "<div class='col-6 col-md-6'>" .
                        "<p>" . $item->comment . "</p>" .
                        "</div>" .
                        "<div class='col-3 col-md-3'>" .
                        "<a class='btn btn-danger' href='javascript:void(0)'>Delete<a>" .
                        "</div>" .
                        "</div>" .
                        "</div><hr class='my-3' />";
                }
                return $list;
                // if (isEmpty($all_comment)) {
                //     return response()->json(["status" => 200, "message" => "Fetchecd .....", "data" => $list]);
                // } else {
                //     return response()->json(["status" => 200, "message" => "No Comments ...", "data" => null]);
                // }
                // !isEmpty($all_comment) ? $res = ["status" => 200, "message" => "No Comments ...", "data" => null] :
                //     $res = ["status" => 200, "message" => "Fetchecd .....", "data" => $list];
                // return response()->json($res);
            } else {
                return $all_comment;
            }
        } else {
            return abort(404);
        }
    }
}
