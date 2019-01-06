<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePost;

class PostController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if (Auth::check())
            return view('posts.create', compact('posts'));
        else
            return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $post = Post::create($request->merge([
            'password' => ($request->password ? bcrypt($request->password) : null),
        ])->toArray());
        session(["post_{$post->id}_password" => $request->get('password')]);

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
        $postPassword = session('post_' . $post->id . '_password');
        if (password_verify(($postPassword ? $postPassword : $request->password), $post->password)) {
            return view('posts.show', compact('post'));
        } else {
            return view('posts.passCheck', ['post' => $post]);
        }
    }

    public function passwordCheck(Post $post, Request $request)
    {
        if (password_verify($request->password, $post->password)) {
            session(['post_' . $post->id . '_password' => $request->password]);
            return redirect("/posts/{$post->id}");
        } else {
            return view('posts.passCheck', ['post' => $post])->withErrors(['inValidPasswrod'=>'Wrong Password']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
