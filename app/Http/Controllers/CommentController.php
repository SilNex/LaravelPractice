<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('passwordHashing')->only(['store']);
    }

    public function index(Request $request)
    {
        $post = Post::findOrFail($request->route('post'));
        $post->comments()->each(function ($comment) {
            dump($comment);
        });
        return;
    }

    public function create()
    {
        // dump(request()->route('post'));
    }

    public function store(Post $post, Request $request)
    {
        if (!$post->vaildatePassword($request->password)) {
            abort(403);
        }

        $attribute = $request->validate([
            'description' => ['required', 'min:10'],
        ]);
        
        $attribute += [
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ];

        $comment = Comment::create($attribute);

        return $comment;
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    public function edit(Comment $comment)
    {
        // return edit view
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
