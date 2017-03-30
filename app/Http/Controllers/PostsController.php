<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::orderBY('id', 'desc')->paginate(10);

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

    public function create()
    {

        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        /*
            $post = new Post;

            $post->title = $request->get('title');
            $post->description = $request->get('description');
            $post->url = $request->get('url');
            $post->save();
        */
        //dd($request->all());

        $post = Post::created($request->only('title', 'description', 'url'));

        return redirect()->route('posts_path');
    }
}
