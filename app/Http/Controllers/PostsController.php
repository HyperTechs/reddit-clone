<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::all ();

        return view('posts.index')->with('posts', $posts);
    }

    public function show( Post $post)
    {
        /*
            $post = Post::find($postId);

            if( is_null( $postId )){

                abort(404);
            }
        */
        return view('posts.show')->with('post', $post);
    }
}
