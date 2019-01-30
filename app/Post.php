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

    public function comments()
    {
        return $this->belongsTo('App\Comment');
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

    public function previousPostId()
    {
        $previousPostId = Post::where('id', '<', $this->id)->take(1)->pluck('id');
        if ($previousPostId->isNotEmpty()) {
            return $previousPostId->first();
        } else {
            return null;
        }
    }

    public function nextPostId()
    {
        $nextPostId = Post::where('id', '>', $this->id)->take(1)->pluck('id');
        if ($nextPostId->isNotEmpty()) {
            return $nextPostId->first();
        } else {
            return null;
        }
    }

}
