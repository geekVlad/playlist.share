<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\CommentsRowCreated;
use App\Events\CommentsRowDeleted;

class Comment extends Model
{
    protected $table = 'comments';

    protected $attributes = [
        'parent_id' => null,
    ];
    
    protected $dispatchesEvents = [
        'created' => CommentsRowCreated::class,
        'deleted' => CommentsRowDeleted::class,
    ];
}
