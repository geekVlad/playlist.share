<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Artist extends Model
{
    protected $table = 'artists';

    // public function albums()
    // {
    //     return $this->hasMany('Models\Album');
    // }

    public function songs()
    {
        return $this->hasMany('App\Models\Song');
    }
}
