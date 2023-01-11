<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostTags;
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

    public function create(Request $request)
    {

        // if ($request->img) {
        //     foreach ($request->img as $key => $image) {
        //         $imageName = time() . rand(1, 99) . '.' . $image->extension();
        //         $imagesrc = imagecreatefromjpeg($image);
        //         $compress =  imagewebp($imagesrc, public_path('/upload/post/image/') . $imageName, 5);
        //     }
        // }
        if ($request->session()->has('company_user')) {
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->pic_fk_id = $request->session()->get('company_user.pic.pic_id');
            $post->company_fk_id = $request->session()->get('company_user.company.company_id');
            $post->post_date = Carbon::now()->toDateString();

            if ($request->ajax()) {
                if ($post->save()) {
                    if ($request->img) {
                        foreach ($request->img as $key => $image) {
                            $imageName = time() . rand(1, 99) . '.' . $image->extension();
                            $imagesrc = imagecreatefromjpeg($image);
                            imagewebp($imagesrc, public_path('/upload/post/image/') . $imageName, 5);
                            // $imageName = time() . rand(1, 99) . '.' . $image->extension();
                            // $image->move(public_path('/upload/post/image/'), $imageName);
                            $post_image = new PostImage();
                            $post_image->post_fk_id = $post->post_id;
                            $post_image->image_path = '/upload/post/image/' . $imageName;
                            $post_image->insert_date = Carbon::now()->toDateString();
                            $post_image->save();
                        }
                    }
                    $data = explode(',', $request->post('hidden-tags'));
                    if (!empty($data)) {
                        foreach ($data as $key => $str) {
                            $tags = new PostTags();
                            $tags->tag = $str;
                            $tags->post_fk_id = $post->post_id;
                            $tags->tag_date = Carbon::now()->toDateString();
                            $tags->save();
                        }
                    }
                    return response()->json(["status" => 200, "message" => "Post created ..."]);
                } else {
                    return response()->json(["status" => 500, "message" => "Post create faild ..."]);
                }
            } else {
                if ($post->save()) {
                    if ($request->img) {
                        foreach ($request->img as $key => $image) {
                            $imageName = time() . rand(1, 99) . '.' . $image->extension();
                            $imagesrc = imagecreatefromjpeg($image);
                            imagewebp($imagesrc, public_path('/upload/post/image/') . $imageName, 5);
                            // $imageName = time() . rand(1, 99) . '.' . $image->extension();
                            // $image->move(public_path('/upload/post/image/'), $imageName);
                            $post_image = new PostImage();
                            $post_image->post_fk_id = $post->post_id;
                            $post_image->image_path = '/upload/post/image/' . $imageName;
                            $post_image->insert_date = Carbon::now()->toDateString();
                            $post_image->save();
                        }
                    }
                    $data = explode(',', $request->post('hidden-tags'));
                    if (!empty($data)) {
                        foreach ($data as $key => $str) {
                            $tags = new PostTags();
                            $tags->tag = $str;
                            $tags->post_fk_id = $post->post_id;
                            $tags->tag_date = Carbon::now()->toDateString();
                            $tags->save();
                        }
                    }
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
