<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\LikesRowCreated;
use App\Events\LikesRowDeleted;

class Likes extends Model
{
    protected $table = 'likes';
    public $timestamps = false;
    
    protected $dispatchesEvents = [
        'created' => LikesRowCreated::class,
        'deleted' => LikesRowDeleted::class,
    ];
}
