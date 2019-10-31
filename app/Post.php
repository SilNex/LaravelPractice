<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function board()
    {
        return $this->belongsTo('App\Board');
    }
}
