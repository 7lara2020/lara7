<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Post;
use Auth;

class PostController extends Controller
{
    function post(Request $req)
    {
        $perPage = 5;
        if ($req->has('perPage')) {
            $perPage = (int) $req->perPage;
        }
        $query = Post::whereNull('deleted_at')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->with('user');
        $posts = $query->paginate($perPage);
            if ($req->ajax()) {
                if (View::exists('post_listing')) {
                    return view('post_listing',['posts' => $posts,'perPage' => $perPage]);
                }
            }
        if (View::exists('post_main')) {
            return view('post_main',['posts' => $posts,'perPage' => $perPage]);
        } else {
            return 'view not exist';
        }
    }

    function createNewPost(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::user()->id;
        if ($post->save()) {
            $request->session()->flash('success','Post Created Successfully!!!!!!!!!!!!!!');
        } else {
            $request->session()->flash('success','Post Created Successfully!!!!!!!!!!!!!!');
        }
        return redirect('post');
    }

    function deletePost(Request $req)
    {
        $post = Post::find($req->confirm_deleteid);
        if ($post->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Post Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Post Deletion Failed',
            ]);
        }
    }

    function editPost(Request $req)
    {
        $post = Post::find($req->post_id);
        $post->title = $req->post_title;
        $post->description = $req->post_description;
        if ($post->save()) {
            return response()->json([
                'status' => 'success',
                'post' => $post,
                'message' => 'Post Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $errors,
            ]);
        }
    }

    function allPost()
    {
        $posts = Post::all();
        if (View::exists('all_posts_main')) {
            return view('all_posts_main',['posts' => $posts]);
        } else {
            return 'view not exist';
        }
    }
}
