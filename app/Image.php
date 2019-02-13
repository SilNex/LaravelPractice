<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['storeage_path', 'real_name', 'original_name'];

    public function getImageURI()
    {
        return route('images.show') . $this->original_name;
    }
}
