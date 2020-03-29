<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\CommentsRowCreated;
use App\Events\CommentsRowDeleted;
use App\Models;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'playlist_id', 'message'
    ];

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
    public static function getNickname()
    {

        $nickname = User::find('id', $this->user_id)->first();

        return $nickname;
    }

    public function playlists()
    {
    	return $this->belongsTo('App\Models\Playlist');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function childrens()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }
}
