<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Album extends Model
{
    protected $table = 'albums';

    // public function artists()
    // {
    //     return $this->belongsTo('Models\Artist');
    // }

    // public function songs()
    // {
    //     return $this->hasMany('Models\Song');
    // }
}
