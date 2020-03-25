<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\CommentsRowCreated;
use App\Events\CommentsRowDeleted;
use App\Models;

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

    // public function parent()
    // {
    //     return $this->belongsTo('App\Models\Comment', 'parent_id');
    // }

    // public function children()
    // {
    //     return $this->hasMany('App\Models\Comment', 'parent_id');
    // }

    public function playlists()
    {
    	return $this->belongsTo('App\Models\Playlist');
    }


}
