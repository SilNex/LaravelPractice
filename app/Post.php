<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use Notifiable;

    protected $fillable = [
        'title', 'description', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
