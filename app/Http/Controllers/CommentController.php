<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
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
            $all_comment = Post::join('comment', 'comment.post_fk_id', '=', 'post.post_id')
                ->where('post_id', $request->id)
                ->get();

            if ($request->ajax()) {
                !isEmpty($all_comment) ? $res = ["status" => 200, "message" => "No Comments ...", "data" => null] :
                    $res = ["status" => 200, "message" => "Fetchecd .....", "data" => $all_comment];
                return response()->json($res);
            } else {
                return $all_comment;
            }
        } else {
            return abort(404);
        }
    }
}
