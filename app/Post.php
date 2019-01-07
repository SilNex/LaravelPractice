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
            $session = session('post_' . $this->id . '_password');
            $password = (is_null($session) ? $password : $session);
            return Hash::check($password, $this->password);
        }
    }

    public function hasPost($id)
    {
        return (is_null(Post::find($id)) ? false : true);
    }

}
