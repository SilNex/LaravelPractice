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
        // 
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
     * Check post password
     */
    public function passwordCheck(Post $post, Request $request)
    {
        if (password_verify($request->password, $post->password)) {
            session(['post_' . $post->id . '_password' => $request->password]);
            return redirect($request->getRequestUri());
        } else {
            return view('posts.passCheck', ['post' => $post])->withErrors(['inValidPasswrod' => 'Wrong Password']);
        }
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
        if (is_null($post->password) || password_verify(($postPassword ? $postPassword : $request->password), $post->password)) {
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
        if (Auth::check()) {
            $postPassword = session('post_' . $post->id . '_password');
            if (is_null($post->password) || password_verify(($postPassword ? $postPassword : $request->password), $post->password)) {
                return view('posts.edit', compact('post'));
            } else {
                return view('posts.passCheck', ['post' => $post]);
            }
        } else {
            return redirect('/login');
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
        $post->update($request->merge([
            'password' => ($request->password === $post->password ? $request->password : bcrypt($request->password)),
        ])->toArray());
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

    }
}
