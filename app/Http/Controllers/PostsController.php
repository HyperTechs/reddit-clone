<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::orderBY('id', 'desc')->paginate(10);

        return view('posts.index')->with(['posts' => $posts]);
    }

    public function show( Post $post)
    {
        /*
            $post = Post::find($postId);

            if( is_null( $postId )){

                abort(404);
            }
        */
        return view('posts.show')->with(['post' => $post]);
    }

    public function create()
    {
        $post = new Post;

        return view('posts.create')->with([ 'post' => $post]);
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

        $post = Post::create($request->only('title', 'description', 'url'));

        session()->flash('message', 'Post Creado');

        return redirect()->route('posts_path');
    }

    public function edit(Post $post)
    {
        return view ('posts.edit')->with([ 'post' => $post ]);
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $post->update(
            $request->only('title', 'description', 'url')
        );

        session()->flash('message', 'Post Update');

        return redirect()->route('post_path', [ 'post' => $post->id ]);
    }

    public function delete(Post $post)
    {
        $post->delete();

        session()->flash('message', 'Post Deleted');

        return redirect()->route('posts_path');
    }
}
