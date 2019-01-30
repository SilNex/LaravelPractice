<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Post::find($request->route('post'));
        dump($comments->comments());
        return;
    }

    public function create()
    {
        // dump(request()->route('post'));
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'description' => ['required', 'min:10'],
        ]);
        
        $attribute += [
            'user_id' => auth()->id(),
            'post_id' => request()->route('post'),
        ];

        $comment = Comment::create($attribute);

        return $comment;
    }

    public function show(Comment $comment)
    {
        dump($comment->post());
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
