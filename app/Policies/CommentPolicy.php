<?php

namespace App\Policies;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $this->post = Post::find(explode('/', request()->path())[1]);
        $this->boardName = $this->post->board->name;
        if ($user->can("{$this->boardName} use")) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if($user->is($comment->user)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if($user->is($comment->user)) {
            return true;
        }
    }
}
