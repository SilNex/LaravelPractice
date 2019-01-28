<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create()
    {
        // return create view
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'description' => ['required', 'min:10'],
        ]);
        return ;
    }

    public function show(Comment $comment)
    {
        //
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
