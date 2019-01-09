<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Post extends Model
{
    use Notifiable;

    protected $fillable = [
        'title', 'description', 'password', 'user_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hasPassword()
    {
        return ($this->password ? true : false);
    }

    public function vaildatePassword($password)
    {
        if (!$this->hasPassword() || auth()->id() === $this->user_id) {
            return true;
        } else {
            return Hash::check($password, $this->password);
        }
    }

    public function previousPost()
    {
        $previousPost = Post::where('id', '<', $this->id)->first();
        if ($previousPost) {
            return route(['posts.show', $previousPost->id]);
        } else {
            return route(['posts.index']);
        }
    }

    public function nextPost()
    {
        $nextPost = Post::where('id', '>', $this->id)->first();
        if ($nextPost) {
            return route(['posts.show', $previousPost->id]);
        } else {
            return route(['posts.index']);
        }
    }

}
