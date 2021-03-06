<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreComment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post, StoreComment $request)
    {
        $comment = Comment::create(array_merge($request->validated(), [
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]));
        $lastPage = $post->comments()->paginate(10)->lastPage();
        return ($comment ? redirect("/{$post->board->name}/posts/{$post->id}?page={$lastPage}") : back());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'redirect' => URL::previous(),
        ]);
    }
}
