<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Post extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = \App\Models\Post::all();
        return view('pages.post.post', compact('posts'));
    }

    public function delete($post_id)
    {
        $user = Auth::user();
        if ($user->can('delete post')) {
            $post = \App\Models\Post::find($post_id);
            $post->status = 0;
            $post->save();
            return redirect()->back();
        } else {
            dd('You don\'t have permission to delete this Post');
        }
    }

    public function active($post_id)
    {
        $user = Auth::user();
        if ($user->can('active post')) {
            $post = \App\Models\Post::find($post_id);
            $post->status = 1;
            $post->save();
            return redirect()->back();
        } else {
            dd('You don\'t have permission to active this Post');
        }
    }



    public function store(Request $request)
    {
        $post = new \App\Models\Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect()->back();
    }
}
