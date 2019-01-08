<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'passCheck']);
        $this->middleware('post.passHashing')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dump($request);
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $attributes = $request->validated();

        if ($request->filled('password'))
            $attributes['password'] = Hash::make($request->password);

        $attributes['user_id'] = auth()->id();

        $post = Post::create($attributes);

        return redirect("/posts/{$post->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Request $request)
    {
        if ($post->vaildatePassword($request->password)) {
            return view('posts.show', compact('post'));
        } else {
            return view('posts.passCheck', ['post' => $post]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Request $request)
    {
        if ($post->vaildatePassword($request->password)) {
            return view('posts.edit', compact('post'));
        } else {
            return view('posts.passCheck', ['post' => $post]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StorePost  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, Post $post)
    {
        $attributes = $request->validated();

        if ($post->password !== $request->password) {
            $attributes['password'] = Hash::make($request->password);
        }

        $post->update($attributes);

        return redirect("/posts/{$post->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user->id === auth()->id()) {
            $post->delete();
        }
        return redirect('/posts');
    }

    /**
     * Check post password
     * /posts/{post} | /posts/{posts}/edit
     */
    public function passwordCheck(Post $post, Request $request)
    {
        if (password_verify($request->password, $post->password)) {
            session(['post_' . $post->id . '_password' => $request->password]);
            return redirect($request->getRequestUri());
        } else {
            return view('posts.passCheck', ['post' => $post])
                ->withErrors(['inValidPasswrod' => 'Wrong Password']);
        }
    }
}
