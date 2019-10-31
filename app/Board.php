<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = [];

    protected $casts = [
        'configs' => 'array'
    ];
}
