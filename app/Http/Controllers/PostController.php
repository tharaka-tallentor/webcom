<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function post_view(Request $request)
    {
        if ($request->session()->has('company_user')) {
            $post = Post::where('company_fk_id', $request->session()->get('company_user.company.company_id'))->paginate(20);
            return view('company.post', compact('post'));
        } else {
            return abort(404, 'Unauthorized action.');
        }
    }

    public function create(PostRequest $request)
    {
        if ($request->session()->has('company_user')) {
            $post = new Post();
            $post->content = $request->content;
            $post->pic_fk_id = $request->session()->get('company_user.pic.pic_id');
            $post->company_fk_id = $request->session()->get('company_user.company.company_id');
            $post->post_date = Carbon::now()->toDateString();

            if ($request->ajax()) {
                !$post->save() ? $res = ["status" => 500, "message" => "Post create faild ..."] : $res = ["status" => 200, "message" => "Post created ..."];
                return response()->json($res);
            } else {
                if ($post->save()) {
                    $request->session()->flash('success', 'Post created ...');
                    return redirect()->route('control_panel.all.company.post');
                } else {
                    $request->session()->falsh('error', 'Post created faild ...');
                    return redirect()->route('control_panel.all.company.post');
                }
            }
        } else {
            if ($request->ajax()) {
                return response()->json(["status" => 404, "message" => "Authorize url", "route" => route('login')]);
            } else {
                return redirect()->route('login');
            }
        }
    }

    public function update(PostRequest $request)
    {
        if ($request->session()->has('company_user')) {
            if ($request->ajax()) {
                !Post::where('post_id', $request->id)->update(["content" => $request->content]) ? $res = ["status" => 500, "message" => "Post create faild ..."] : $res = ["status" => 200, "message" => "Post created ..."];
                return response()->json($res);
            } else {
                if (Post::where('post_id', $request->id)->update(["content" => $request->content])) {
                    $request->session()->flash('success', 'Post updated ...');
                    return redirect()->route('control_panel.all.company.post');
                } else {
                    $request->session()->flash('error', 'Post update faild ...');
                    return redirect()->route('control_panel.all.company.post');
                }
            }
        } else {
            if ($request->ajax()) {
                return response()->json(["status" => 404, "message" => "Authorize url", "route" => route('login')]);
            } else {
                return redirect()->route('login');
            }
        }
    }

    public function delete(Request $request)
    {
        if ($request->session()->has('company_user')) {
            if ($request->ajax()) {
                !Post::where('post_id', $request->id)->delete() ? $res = ["status" => 500, "message" => "Delete faild ..."] : $res = ["status" => 200, "message" => "Delete success ..."];
                return response()->json($res);
            } else {
                if (Post::where('post_id', $request->id)->delete()) {
                    $request->session()->flash('error', 'Post delete faild ...');
                    return redirect()->route('control_panel.all.company.post');
                } else {
                    $request->session()->flash('error', 'Post delete faild ...');
                    return redirect()->route('control_panel.all.company.post');
                }
            }
        } else {
            if ($request->ajax()) {
                return response()->json(["status" => 404, "message" => "Authorize url", "route" => route('login')]);
            } else {
                return redirect()->route('login');
            }
        }
    }
}
