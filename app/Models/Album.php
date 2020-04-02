<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Album extends Model
{
    protected $table = 'albums';

    public function artist()
    {
        return $this->belongsTo('App\Models\Artist');
    }

    public function songs()
    {
        return $this->hasMany('App\Models\Song');
    }
}
