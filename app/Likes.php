<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\LikesRowCreated;
use App\Events\LikesRowDeleted;

class Likes extends Model
{
    protected $table = 'likes';
    public $timestamps = false;
    protected $dispatchesEvents = [
        'saved' => LikesRowCreated::class,
        'deleted' => LikesRowDeleted::class,
    ];
}
