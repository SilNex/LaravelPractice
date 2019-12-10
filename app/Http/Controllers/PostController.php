<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Board $board)
    {
        if (!$board) {
            abort(404);
        }

        return view('post.index', [
            'posts' => $board->posts,
            'board' => $board->name,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Board $board)
    {
        return view('post.create', compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Board $board, StorePost $request)
    {
        $post = Post::create(array_merge($request->validated(), ['board_id' => $board->id, 'user_id' => auth()->user()->id]));
        return $post ? redirect(route('posts.index', $board->name)) : redirect(route('posts.create', $board->name));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board, Post $post)
    {
        return view('post.show', compact(['board', 'post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board, Post $post)
    {
        return view('post.edit', compact(['board', 'post']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePost  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Board $board, StorePost $request, Post $post)
    {
        return $post->update($request->validated()) ? redirect(route('posts.show', [$board->name, $post->id])) : back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board, Post $post)
    {
        $post->delete();
        return response()->json([
            'redirect' => route('posts.index', $board->name),
        ]);
    }
}
